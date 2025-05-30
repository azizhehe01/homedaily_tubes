<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Resources\JasaResource;
use Illuminate\Http\Request;

class JasaApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Menampilkan semua produk dengan kategori 'jasa'
        $jasas = Product::whereHas('category', function ($query) {
            $query->where('category_name', 'jasa');
        })->with(['category'])->paginate(10);

        // Jika tidak ada data, kirim response dengan pesan
        if ($jasas->isEmpty()) {
            return response()->json(['message' => 'Jasa tidak tersedia'], 404);
        }

        return JasaResource::collection($jasas);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Menampilkan detail produk yang memiliki kategori 'jasa'
        $jasa = Product::whereHas('category', function ($query) {
            $query->where('name', 'jasa');
        })->with(['category'])->where('product_id', $id)->first();

        // Jika data tidak ditemukan
        if (!$jasa) {
            return response()->json(['message' => 'Jasa tidak tersedia'], 404);
        }

        return new JasaResource($jasa);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Logika penyimpanan data
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Logika pembaruan data
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Logika penghapusan data
    }
}
