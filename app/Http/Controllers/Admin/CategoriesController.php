<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Menampilkan daftar kategori produk
     */
    public function index()
    {
        $categories = ProductCategory::latest()->get();
        return view('admin.pages.categories', compact('categories'));
    }

    /**
     * Menampilkan form tambah kategori
     */
    public function create()
    {
        return view('admin.pages.input-categories');
    }

    /**
     * Menyimpan kategori baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|string|max:255|unique:product_categories,category_name',
            'description' => 'nullable|string'
        ]);

        ProductCategory::create($validated);

        return redirect()->route('admin.pages.categories')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    /**
     * Menampilkan form edit kategori
     */
    public function edit(ProductCategory $category)
    {
        return view('admin.pages.edit-category', compact('category'));
    }

    /**
     * Mengupdate kategori
     */
    public function update(Request $request, ProductCategory $category)
    {
        $validated = $request->validate([
            'category_name' => 'required|string|max:255|unique:product_categories,category_name,'.$category->category_id.',category_id',
            'description' => 'nullable|string'
        ]);

        $category->update($validated);

        return redirect()->route('admin.pages.categories')
            ->with('success', 'Kategori berhasil diperbarui');
    }

    /**
     * Menghapus kategori
     */
    public function destroy(ProductCategory $category)
    {
        $category->delete();
        
        return redirect()->route('admin.pages.categories')
            ->with('success', 'Kategori berhasil dihapus');
    }
}