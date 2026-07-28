<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;

class PublicUlasanController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'stars' => 'required|integer|min:1|max:5',
            'ulasan' => 'required|string',
        ]);

        Ulasan::create([
            'id_catalog' => $id,
            'nama' => $request->nama,
            'stars' => $request->stars,
            'ulasan' => $request->ulasan,
            'status' => 'Pending', // Status awal masuk ke admin dulu
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Ulasan berhasil dikirim! Ulasan Anda akan ditampilkan setelah disetujui oleh admin.'
        ]);
    }
}