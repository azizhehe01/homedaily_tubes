<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $products = Product::with('category')
            ->latest()
            ->paginate(10);

        return view('admin.pages.products', compact('products'));
    }

    public function create()
    {
        $categories = ProductCategory::select('category_id', 'category_name')->get();
        return view('admin.pages.input-products', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:product_categories,category_id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('admin.pages.products')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('admin.pages.product-detail', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = ProductCategory::all();
        return view('admin.pages.edit-product', compact('product', 'categories'));
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle upload gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('admin.pages.products')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
        
            // Hapus file gambar dari storage jika ada
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
        
            // Hapus record dari database
            $product->delete();
        
            return redirect()
                ->route('admin.pages.products')
                ->with('success', 'Produk berhasil dihapus!');
        
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.pages.products')
                ->with('error', 'Gagal menghapus produk: ' . $e->getMessage());
        }
    }

    
}

