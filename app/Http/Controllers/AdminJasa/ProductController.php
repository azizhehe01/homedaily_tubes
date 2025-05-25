<?php

namespace App\Http\Controllers\AdminJasa;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function frontendIndex()
    {
        $recommendedProducts = Product::with('category')
            ->where('stock', '>', 0) 
            ->orderBy('created_at', 'desc') 
            ->get();

        return view('user.index', compact('recommendedProducts'));
    }

    public function showDetail($product_id)
    {
        $product = Product::with('category')->findOrFail($product_id);
        
        $recommendedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('product_id', '!=', $product->product_id)
            ->where('stock', '>', 0)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();
    
        return view('user.pages.detail-product', compact('product', 'recommendedProducts'));
    }
    public function index()
    {
        $products = Product::with(['category', 'images'])
            ->latest()
            ->paginate(10);

        return view('admin_jasa.pages.products', compact('products'));
    }


    public function create()
    {
        $categories = ProductCategory::select('category_id', 'category_name')->get();
        return view('admin_jasa.pages.input-products', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validasi data produk
        $validatedProduct = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:product_categories,category_id',
            'images' => 'required|array|min:1|max:3',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Simpan produk terlebih dahulu
        $product = Product::create([
            'name' => $validatedProduct['name'],
            'description' => $validatedProduct['description'],
            'price' => $validatedProduct['price'],
            'stock' => $validatedProduct['stock'],
            'category_id' => $validatedProduct['category_id']
        ]);

        // Simpan gambar-gambar
        foreach ($request->file('images') as $index => $image) {
            $path = $image->store('products', 'public');
            
            Image::create([
                'path' => $path,
                'product_id' => $product->product_id,
                'is_primary' => $index === 0 // Gambar pertama sebagai primary
            ]);
        }

        return redirect()->route('admin_jasa.pages.products')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('admin_jasa.pages.product-detail', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = ProductCategory::all();
        return view('admin_jasa.pages.edit-product', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:product_categories,category_id',
            'new_images' => 'nullable|array|max:3',
            'new_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'deleted_images' => 'nullable|array',
            'deleted_images.*' => 'exists:images,image_id,product_id,'.$id,
            'primary_image' => 'nullable|exists:images,image_id,product_id,'.$id
        ]);

        // Update product data
        $product->update($validated);

        // Handle deleted images
        if ($request->has('deleted_images')) {
            $imagesToDelete = Image::whereIn('image_id', $request->deleted_images)
                                 ->where('product_id', $product->product_id)
                                 ->get();

            foreach ($imagesToDelete as $image) {
                try {
                    Storage::disk('public')->delete($image->path);
                    $image->delete();
                } catch (\Exception $e) {
                    Log::error("Failed to delete image: ".$e->getMessage());
                    continue;
                }
            }
        }

        // Handle new images upload
        if ($request->hasFile('new_images')) {
            // Check if total images won't exceed limit (e.g. 3)
            $currentImagesCount = $product->images()->count();
            $newImagesCount = count($request->file('new_images'));
            $deletedCount = $request->has('deleted_images') ? count($request->deleted_images) : 0;

            if (($currentImagesCount - $deletedCount + $newImagesCount) > 3) {
                return back()->withErrors(['new_images' => 'You can only have maximum 3 images per product']);
            }

            foreach ($request->file('new_images') as $image) {
                $path = $image->store('products', 'public');

                Image::create([
                    'path' => $path,
                    'product_id' => $product->product_id,
                    'is_primary' => false
                ]);
            }
        }

        // Handle primary image change
        if ($request->has('primary_image')) {
            // Reset all primary flags first
            Image::where('product_id', $product->product_id)
                 ->update(['is_primary' => false]);

            // Set the new primary image
            Image::where('image_id', $request->primary_image)
                 ->where('product_id', $product->product_id)
                 ->update(['is_primary' => true]);
        }
        // If no primary image is set and there are images, set the first one as primary
        elseif ($product->images()->count() > 0 && $product->images()->where('is_primary', true)->count() === 0) {
            $product->images()->first()->update(['is_primary' => true]);
        }

        return redirect()->route('admin_jasa.pages.products')
            ->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $product = Product::findOrFail($id);

            // Delete all related images from storage and database
            foreach ($product->images as $image) {
                try {
                    // Delete physical file
                    if (Storage::disk('public')->exists($image->path)) {
                        Storage::disk('public')->delete($image->path);
                    }
                    // Delete database record
                    $image->delete();
                } catch (\Exception $e) {
                    Log::error("Failed to delete product image ID {$image->id}: " . $e->getMessage());
                    // Continue with next image even if one fails
                }
            }

            // Delete the product itself
            $product->delete();

            DB::commit();

            return redirect()
                ->route('admin_jasa.pages.products')
                ->with('success', 'Product deleted successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Product deletion failed: " . $e->getMessage());

            return redirect()
                ->route('admin_jasa.pages.products')
                ->with('error', 'Failed to delete product: ' . $e->getMessage());
        }
    }  
}

