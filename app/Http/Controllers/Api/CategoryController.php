<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    // Apply middleware for authentication
    // List all categories
    public function index()
    {
        $user = Auth::user(); // Get the authenticated user
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $categories = ProductCategory::select('category_id', 'category_name', 'description', 'created_at')->get();
        return response()->json(['categories' => $categories], 200);
    }

    // Show a single category
    public function show($id)
    {
        $user = Auth::user(); // Get the authenticated user
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $category = ProductCategory::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json(['category' => $category], 200);
    }

    // Create a new category
    public function store(Request $request)
    {
        $user = Auth::user(); // Get the authenticated user
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $request->validate([
            'category_name' => 'required|string|max:255|unique:product_categories,category_name',
            'description' => 'nullable|string',
        ]);

        $category = ProductCategory::create([
            'category_name' => $request->category_name,
            'description' => $request->description,
        ]);

        return response()->json(['category' => $category, 'message' => 'Category created successfully'], 201);
    }

    // Update an existing category
    public function update(Request $request, $id)
    {
        $user = Auth::user(); // Get the authenticated user
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $category = ProductCategory::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $request->validate([
            'category_name' => 'required|string|max:255|unique:product_categories,category_name,'.$category->category_id.',category_id',
            'description' => 'nullable|string',
        ]);

        $category->update([
            'category_name' => $request->category_name,
            'description' => $request->description,
        ]);

        return response()->json(['category' => $category, 'message' => 'Category updated successfully'], 200);
    }

    // Delete a category
    public function destroy($id)
    {
        $user = Auth::user(); // Get the authenticated user
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $category = ProductCategory::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $category->delete();

        return response()->json(['message' => 'Category deleted successfully'], 200);
    }
}