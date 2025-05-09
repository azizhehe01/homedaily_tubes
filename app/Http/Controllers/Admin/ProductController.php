<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.products');
    }

    // /**
    //  * Show the form for creating a new resource.
    //  */

    // Create - Form tambah produk
    public function create()
    {
        return view('admin.pages.input-products');
    }

    /**
     * Store a newly created resource in storage.
     */

    // // Store - Simpan produk baru
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'name' => 'required|max:255',
    //         'description' => 'nullable',
    //         'price' => 'required|numeric',
    //         'stock' => 'required|integer',
    //         'category' => 'required|in:product,jasa',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     if ($request->hasFile('image')) {
    //         $imagePath = $request->file('image')->store('products', 'public');
    //         $validated['image'] = $imagePath;
    //     }

    //     Product::create($validated);

    //     return redirect()->route('products.index')
    //         ->with('success', 'Product created successfully.');
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // // Show - Detail produk
    // public function show(Product $product)
    // {
    //     return view('admin.products.show', compact('product'));
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */

    // public function edit(Product $product)
    // {
    //     return view('admin.products.edit', compact('product'));
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */

    // // Update - Update produk
    // public function update(Request $request, Product $product)
    // {
    //     $validated = $request->validate([
    //         'name' => 'required|max:255',
    //         'description' => 'nullable',
    //         'price' => 'required|numeric',
    //         'stock' => 'required|integer',
    //         'category' => 'required|in:product,jasa',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     if ($request->hasFile('image')) {
    //         // Hapus gambar lama jika ada
    //         if ($product->image) {
    //             Storage::disk('public')->delete($product->image);
    //         }

    //         $imagePath = $request->file('image')->store('products', 'public');
    //         $validated['image'] = $imagePath;
    //     }

    //     $product->update($validated);

    //     return redirect()->route('products.index')
    //         ->with('success', 'Product updated successfully.');
    // }

    // public function destroy(Product $product)
    // {
    //     // Hapus gambar jika ada
    //     if ($product->image) {
    //         Storage::disk('public')->delete($product->image);
    //     }

    //     $product->delete();

    //     return redirect()->route('products.index')
    //         ->with('success', 'Product deleted successfully.');
    // }
}
