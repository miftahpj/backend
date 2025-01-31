<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    // GET: Ambil semua data produk
    public function index()
    {
        $products = Product::all();
        return response()->json($products, Response::HTTP_OK);
    }

    // GET: Ambil satu produk berdasarkan ID
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(["message" => "Produk tidak ditemukan"], Response::HTTP_NOT_FOUND);
        }

        return response()->json($product, Response::HTTP_OK);
    }

    // POST: Tambah produk baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|string'
        ]);

        $product = Product::create($request->all());

        return response()->json([
            "message" => "Produk berhasil ditambahkan",
            "product" => $product
        ], Response::HTTP_CREATED);
    }

    // PUT/PATCH: Update produk berdasarkan ID
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(["message" => "Produk tidak ditemukan"], Response::HTTP_NOT_FOUND);
        }

        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric',
            'image' => 'nullable|string'
        ]);

        $product->update($request->all());

        return response()->json([
            "message" => "Produk berhasil diperbarui",
            "product" => $product
        ], Response::HTTP_OK);
    }

    // DELETE: Hapus produk berdasarkan ID
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(["message" => "Produk tidak ditemukan"], Response::HTTP_NOT_FOUND);
        }

        $product->delete();

        return response()->json(["message" => "Produk berhasil dihapus"], Response::HTTP_OK);
    }
}
