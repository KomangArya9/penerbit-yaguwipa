<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthorPublicController extends Controller
{
    // Menampilkan daftar penulis di sisi USER (Hanya yang statusnya 'show')
    public function index()
    {
        $authors = Author::where('status', 'show')->latest()->paginate(6);
        
        return view('penulis', compact('authors'));
    }

    // Menyimpan data pendaftaran baru dari form modal publik user
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'institusi' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'nomor' => 'nullable|string|max:50',
            'social_media' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'keahlian' => 'nullable|string|max:255',
            'profile' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->nama);
        $data['status'] = 'pending'; // Default pending agar masuk ke daftar verifikasi admin dulu

        
        // Handle upload foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            // Simpan ke storage/app/public/authors
            $path = $file->store('authors', 'public'); 
            $data['foto'] = $path; // Hasilnya akan berupa 'authors/namafile.jpg'
        }

        Author::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Pendaftaran berhasil! Data Anda sedang ditinjau oleh admin.'
        ]);
    }
}