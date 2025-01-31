<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CareerController extends Controller
{
    // GET: Ambil semua data career
    public function index()
    {
        $careers = Career::all();
        return response()->json($careers, Response::HTTP_OK);
    }

    // GET: Ambil satu career berdasarkan ID
    public function show($id)
    {
        $career = Career::find($id);

        if (!$career) {
            return response()->json(["message" => "Career tidak ditemukan"], Response::HTTP_NOT_FOUND);
        }

        return response()->json($career, Response::HTTP_OK);
    }

    // POST: Tambah career baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string'
        ]);

        $career = Career::create($request->all());

        return response()->json([
            "message" => "Career berhasil ditambahkan",
            "career" => $career
        ], Response::HTTP_CREATED);
    }

    // PUT/PATCH: Update career berdasarkan ID
    public function update(Request $request, $id)
    {
        $career = Career::find($id);

        if (!$career) {
            return response()->json(["message" => "Career tidak ditemukan"], Response::HTTP_NOT_FOUND);
        }

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string'
        ]);

        $career->update($request->all());

        return response()->json([
            "message" => "Career berhasil diperbarui",
            "career" => $career
        ], Response::HTTP_OK);
    }

    // DELETE: Hapus career berdasarkan ID
    public function destroy($id)
    {
        $career = Career::find($id);

        if (!$career) {
            return response()->json(["message" => "Career tidak ditemukan"], Response::HTTP_NOT_FOUND);
        }

        $career->delete();

        return response()->json(["message" => "Career berhasil dihapus"], Response::HTTP_OK);
    }
}

