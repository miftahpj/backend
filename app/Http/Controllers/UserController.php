<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    // GET: Ambil semua data user
    public function index()
    {
        $users = User::all();
        return response()->json($users, Response::HTTP_OK);
    }

    // GET: Ambil satu user berdasarkan ID
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(["message" => "User tidak ditemukan"], Response::HTTP_NOT_FOUND);
        }

        return response()->json($user, Response::HTTP_OK);
    }

    // POST: Tambah user baru
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'email' => 'required|email',
            'role' => 'required|string'
        ]);

        $user = User::create($request->all());

        return response()->json([
            "message" => "User berhasil ditambahkan",
            "user" => $user
        ], Response::HTTP_CREATED);
    }

    // PUT/PATCH: Update user berdasarkan ID
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(["message" => "User tidak ditemukan"], Response::HTTP_NOT_FOUND);
        }

        $request->validate([
            'username' => 'sometimes|required|string|max:255',
            'password' => 'sometimes|required|string|min:6',
            'email' => 'sometimes|required|email',
            'role' => 'sometimes|required|string'
        ]);

        $user->update($request->all());

        return response()->json([
            "message" => "User berhasil diperbarui",
            "user" => $user
        ], Response::HTTP_OK);
    }

    // DELETE: Hapus user berdasarkan ID
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(["message" => "User tidak ditemukan"], Response::HTTP_NOT_FOUND);
        }

        $user->delete();

        return response()->json(["message" => "User berhasil dihapus"], Response::HTTP_OK);
    }
}
