<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::withCount('fotos')->latest()->get();
        return view('admin.album.index', compact('albums'));
    }

    public function create()
    {
        return view('admin.album.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:100',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'date' => 'required|date',
            'status' => 'required',
            'hit' => 'nullable|integer|min:0', // Validasi hit
        ]);

        // Upload file gambar cover album
        $imagePath = null;
        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('foto', 'public');
        }

        // 1. Simpan data utama ke tabel albums termasuk 'img' cover
        $album = Album::create([
            'title' => $request->title,
            'img' => $imagePath ?? '',
            'hit' => $request->hit ?? 0, // Otomatis 0 jika kosong, atau sesuai inputan admin
            'slug' => Str::slug($request->title),
            'date' => $request->date,
            'status' => $request->status,
        ]);

        // 2. Upload file gambar dan masukkan juga ke tabel foto relasi
        if ($imagePath) {
            Foto::create([
                'id_album' => $album->id,
                'img' => $imagePath,
            ]);
        }

        return redirect()->route('admin.album.index')->with('success', 'Album dan foto berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $album = Album::with('fotos')->findOrFail($id);
        return view('admin.album.edit', compact('album'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:100',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'date' => 'required|date',
            'status' => 'required',
            'hit' => 'nullable|integer|min:0', // Validasi hit
        ]);

        $album = Album::findOrFail($id);

        $updateData = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'date' => $request->date,
            'status' => $request->status,
            'hit' => $request->hit ?? $album->hit, // Update sesuai input admin, atau tetap jika kosong
        ];

        // Jika ada upload foto baru saat diedit
        if ($request->hasFile('img')) {
            // Hapus file cover lama album jika ada
            if ($album->img && Storage::disk('public')->exists($album->img)) {
                Storage::disk('public')->delete($album->img);
            }

            $imagePath = $request->file('img')->store('foto', 'public');
            $updateData['img'] = $imagePath;

            $fotoLama = Foto::where('id_album', $album->id)->first();

            // Hapus file fisik lama jika ada dan berbeda dari cover
            if ($fotoLama && $fotoLama->img && $fotoLama->img !== $album->img && Storage::disk('public')->exists($fotoLama->img)) {
                Storage::disk('public')->delete($fotoLama->img);
            }

            // Update atau buat data foto baru di tabel foto
            Foto::updateOrCreate(
                ['id_album' => $album->id],
                ['img' => $imagePath]
            );
        }

        $album->update($updateData);

        return redirect()->route('admin.album.index')->with('success', 'Album berhasil diperbarui.');
    }

    // Fungsi untuk menambah banyak foto ke dalam suatu album (Opsional jika ingin dipakai kembali)
    public function storeFoto(Request $request, $id)
    {
        $request->validate([
            'img.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5048',
        ]);

        if ($request->hasFile('img')) {
            foreach ($request->file('img') as $file) {
                $imagePath = $file->store('foto', 'public');

                Foto::create([
                    'id_album' => $id,
                    'img' => $imagePath,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Foto-foto tambahan berhasil ditambahkan.');
    }

    // Fungsi untuk menghapus foto satuan dari album
    public function destroyFoto($id)
    {
        $foto = Foto::findOrFail($id);

        if ($foto->img && Storage::disk('public')->exists($foto->img)) {
            Storage::disk('public')->delete($foto->img);
        }

        $foto->delete();

        return redirect()->back()->with('success', 'Foto berhasil dihapus.');
    }

    public function destroy($id)
    {
        $album = Album::with('fotos')->findOrFail($id);

        // Hapus file cover album
        if ($album->img && Storage::disk('public')->exists($album->img)) {
            Storage::disk('public')->delete($album->img);
        }

        // Hapus semua file foto relasi di storage dan database
        foreach ($album->fotos as $foto) {
            if ($foto->img && $foto->img !== $album->img && Storage::disk('public')->exists($foto->img)) {
                Storage::disk('public')->delete($foto->img);
            }
            $foto->delete();
        }

        $album->delete();

        return redirect()->back()->with('success', 'Album berhasil dihapus.');
    }
}