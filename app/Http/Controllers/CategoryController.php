<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    // GET: Ambil semua data kategori
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories, Response::HTTP_OK);
    }

    // GET: Ambil satu kategori berdasarkan ID
    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(["message" => "Kategori tidak ditemukan"], Response::HTTP_NOT_FOUND);
        }

        return response()->json($category, Response::HTTP_OK);
    }

    // POST: Tambah kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $category = Category::create($request->all());

        return response()->json([
            "message" => "Kategori berhasil ditambahkan",
            "category" => $category
        ], Response::HTTP_CREATED);
    }

    // PUT/PATCH: Update kategori berdasarkan ID
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(["message" => "Kategori tidak ditemukan"], Response::HTTP_NOT_FOUND);
        }

        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $category->update($request->all());

        return response()->json([
            "message" => "Kategori berhasil diperbarui",
            "category" => $category
        ], Response::HTTP_OK);
    }

    // DELETE: Hapus kategori berdasarkan ID
    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(["message" => "Kategori tidak ditemukan"], Response::HTTP_NOT_FOUND);
        }

        $category->delete();

        return response()->json(["message" => "Kategori berhasil dihapus"], Response::HTTP_OK);
    }
}
