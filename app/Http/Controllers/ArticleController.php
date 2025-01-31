<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ArticleController extends Controller
{
    // GET
    public function index()
    {
        // Menggunakan pagination untuk menghindari data terlalu besar
        $articles = Article::with(['author', 'category'])->paginate(10);
        return response()->json($articles, Response::HTTP_OK);
    }

    // GET: berdasarkan ID
    public function show($id)
    {
        // Menggunakan findOrFail untuk lebih ringkas
        $article = Article::with(['author', 'category'])->findOrFail($id);
        return response()->json($article, Response::HTTP_OK);
    }

    // POST:
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'author_id' => 'required|integer',
            'category_id' => 'required|integer',
            'image' => 'nullable|string'
        ]);

        $article = Article::create($request->all());

        return response()->json([
            "message" => "Artikel berhasil ditambahkan",
            "article" => $article
        ], Response::HTTP_CREATED);
    }

    // PUT/PATCH: Update artikel berdasarkan ID
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required',
            'author_id' => 'sometimes|required|integer',
            'category_id' => 'sometimes|required|integer',
            'image' => 'nullable|string'
        ]);

        // Menggunakan only untuk menghindari input yang tidak diizinkan
        $article->update($request->only(['title', 'content', 'author_id', 'category_id', 'image']));

        return response()->json([
            "message" => "Artikel berhasil diperbarui",
            "article" => $article
        ], Response::HTTP_OK);
    }

    // DELETE: Hapus artikel berdasarkan ID
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return response()->json(["message" => "Artikel berhasil dihapus"], Response::HTTP_OK);
    }
}
    