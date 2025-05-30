<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    public function index()
    {
        $products = Product::with(['category', 'images'])->paginate(10);
        return ProductResource::collection($products);
    }

    public function show($id)
    {
        $product = Product::with(['category', 'images'])->findOrFail($id);
        return new ProductResource($product);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:product_categories,id',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $product = Product::create($request->only([
            'name',
            'description',
            'price',
            'stock',
            'category_id'
        ]));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $product->images()->create([
                    'path' => $path,
                    'is_primary' => false
                ]);
            }
        }

        return new ProductResource($product);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'price' => 'sometimes|numeric',
            'stock' => 'sometimes|integer',
            'category_id' => 'sometimes|exists:product_categories,id',
            'images.*' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $product->update($request->only([
            'name',
            'description',
            'price',
            'stock',
            'category_id'
        ]));

        if ($request->hasFile('images')) {
            // Delete old images
            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image->path);
                $image->delete();
            }

            // Add new images
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $product->images()->create([
                    'path' => $path,
                    'is_primary' => false
                ]);
            }
        }

        return new ProductResource($product);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Delete associated images
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->path);
            $image->delete();
        }

        $product->delete();
        return response()->json(null, 204);
    }
}
