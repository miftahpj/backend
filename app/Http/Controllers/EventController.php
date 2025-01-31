<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EventController extends Controller
{
    // GET: Ambil semua data event
    public function index()
    {
        $events = Event::all();
        return response()->json($events, Response::HTTP_OK);
    }

    // GET: Ambil satu event berdasarkan ID
    public function show($id)
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json(["message" => "Event tidak ditemukan"], Response::HTTP_NOT_FOUND);
        }

        return response()->json($event, Response::HTTP_OK);
    }

    // POST: Tambah event baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string'
        ]);

        $event = Event::create($request->all());

        return response()->json([
            "message" => "Event berhasil ditambahkan",
            "event" => $event
        ], Response::HTTP_CREATED);
    }

    // PUT/PATCH: Update event berdasarkan ID
    public function update(Request $request, $id)
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json(["message" => "Event tidak ditemukan"], Response::HTTP_NOT_FOUND);
        }

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string'
        ]);

        $event->update($request->all());

        return response()->json([
            "message" => "Event berhasil diperbarui",
            "event" => $event
        ], Response::HTTP_OK);
    }

    // DELETE: Hapus event berdasarkan ID
    public function destroy($id)
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json(["message" => "Event tidak ditemukan"], Response::HTTP_NOT_FOUND);
        }

        $event->delete();

        return response()->json(["message" => "Event berhasil dihapus"], Response::HTTP_OK);
    }
}
