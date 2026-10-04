<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CatalogController extends Controller
{
    public function index()
    {
        $catalogs = Catalog::latest()->get();
        return view('admin.catalog.index', compact('catalogs'));
    }

    public function create()
    {
        return view('admin.catalog.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'          => 'required|string|max:255|unique:catalog,judul',
            'status'         => 'nullable|in:Show,Hide,Pending',
            'penulis'        => 'nullable|string|max:255',
            'editor'         => 'nullable|string|max:255',
            'penerbit'       => 'nullable|string|max:255',
            'i_penulis'      => 'nullable|string|max:255',
            'i_editor'       => 'nullable|string|max:255',
            'jenis'          => 'nullable|string|max:100',
            'kategori'       => 'nullable|string|max:100',
            'bidang'         => 'nullable|string|max:255',
            'isbn'           => 'nullable|string|max:50',
            'issn'           => 'nullable|string|max:50',
            'ukuran'         => 'nullable|string|max:50',
            'jumlah'         => 'nullable|integer',
            'terbit'         => 'nullable|string|max:50',
            'kondisi'        => 'nullable|string|max:50',
            'ketersediaan'   => 'nullable|string|max:50',
            'keterangan'     => 'nullable|string|max:255',
            'deskripsi'      => 'nullable|string',
            'info'           => 'nullable|string',
            'harga'          => 'nullable|string|max:100',
            'diskon'         => 'nullable|string|max:100',
            'penjual'        => 'nullable|string|max:255',
            'wa'             => 'nullable|string|max:50',
            'alamat'         => 'nullable|string',
            'ktp'            => 'nullable|string|max:50',
            'bank'           => 'nullable|string|max:100',
            'norek'          => 'nullable|string|max:100',
            'cover'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'cover_belakang' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'img'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'soft_file'      => 'nullable|file|max:5120',
        ]);

        $data = $request->except(['cover', 'cover_belakang', 'img', 'soft_file']);
        $data['slug'] = Str::slug($request->judul);
        $data['status'] = $request->status ?? 'Show';
        $data['date'] = $request->date ?? date('Y-m-d');

        // Handle File Uploads
        $files = ['cover', 'cover_belakang', 'img', 'soft_file'];
        foreach ($files as $file) {
            if ($request->hasFile($file)) {
                $data[$file] = $request->file($file)->store("catalog/{$file}", 'public');
            }
        }

        Catalog::create($data);

        return redirect()->route('admin.catalog.index')->with('success', 'Katalog berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $catalog = Catalog::findOrFail($id);  
        return view('admin.catalog.edit', compact('catalog'));
    }

    public function update(Request $request, $id)
    {
        $catalog = Catalog::findOrFail($id);

        $request->validate([
            'judul'          => 'required|string|max:255|unique:catalog,judul,' . $id,
            'status'         => 'nullable|in:Show,Hide,Pending',
            'penulis'        => 'nullable|string|max:255',
            'editor'         => 'nullable|string|max:255',
            'penerbit'       => 'nullable|string|max:255',
            'i_penulis'      => 'nullable|string|max:255',
            'i_editor'       => 'nullable|string|max:255',
            'jenis'          => 'nullable|string|max:100',
            'kategori'       => 'nullable|string|max:100',
            'bidang'         => 'nullable|string|max:255',
            'isbn'           => 'nullable|string|max:50',
            'issn'           => 'nullable|string|max:50',
            'ukuran'         => 'nullable|string|max:50',
            'jumlah'         => 'nullable|integer',
            'terbit'         => 'nullable|string|max:50',
            'kondisi'        => 'nullable|string|max:50',
            'ketersediaan'   => 'nullable|string|max:50',
            'keterangan'     => 'nullable|string|max:255',
            'deskripsi'      => 'nullable|string',
            'info'           => 'nullable|string',
            'harga'          => 'nullable|string|max:100',
            'diskon'         => 'nullable|string|max:100',
            'penjual'        => 'nullable|string|max:255',
            'wa'             => 'nullable|string|max:50',
            'alamat'         => 'nullable|string',
            'ktp'            => 'nullable|string|max:50',
            'bank'           => 'nullable|string|max:100',
            'norek'          => 'nullable|string|max:100',
            'cover'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'cover_belakang' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'img'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'soft_file'      => 'nullable|file|max:5120',
        ]);

        $data = $request->except(['_token', '_method', 'cover', 'cover_belakang', 'img', 'soft_file']);
        $data['slug'] = Str::slug($request->judul);

        // Update File Uploads & Delete Old Files
        $files = ['cover', 'cover_belakang', 'img', 'soft_file'];
        foreach ($files as $file) {
            if ($request->hasFile($file)) {
                if ($catalog->$file && Storage::disk('public')->exists($catalog->$file)) {
                    Storage::disk('public')->delete($catalog->$file);
                }
                $data[$file] = $request->file($file)->store("catalog/{$file}", 'public');
            }
        }

        $catalog->update($data);

        return redirect()->route('admin.catalog.index')->with('success', 'Data katalog berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $catalog = Catalog::findOrFail($id);

        foreach (['cover', 'cover_belakang', 'img', 'soft_file'] as $field) {
            if ($catalog->$field && Storage::disk('public')->exists($catalog->$field)) {
                Storage::disk('public')->delete($catalog->$field);
            }
        }

        $catalog->delete();

        return redirect()->route('admin.catalog.index')->with('success', 'Katalog berhasil dihapus!');
    }

    public function approve(Request $request, $id)
    {
        $catalog = Catalog::findOrFail($id);
        
        if ($request->filled('status')) {
            $catalog->status = $request->status;
        } else {
            $catalog->status = ($catalog->status === 'Show') ? 'Hide' : 'Show';
        }

        $catalog->save();

        return redirect()->back()->with('success', "Status katalog '{$catalog->judul}' berhasil diubah menjadi {$catalog->status}!");
    }
}