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
        $this->validateCatalog($request);

        $data = $request->except(['cover', 'cover_belakang', 'img', 'soft_file']);
        $data['slug'] = $this->generateUniqueSlug($request->judul);
        $data['status'] = $request->status ?? 'Show';
        $data['date'] = $request->date ?? date('Y-m-d');
        $data['hite'] = $request->filled('hite') ? (int) $request->hite : 0;

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

        $this->validateCatalog($request, (int) $id);

        $data = $request->except(['_token', '_method', 'cover', 'cover_belakang', 'img', 'soft_file']);
        $data['slug'] = $this->generateUniqueSlug($request->judul, (int) $id);
        $data['hite'] = $request->filled('hite') ? (int) $request->hite : ($catalog->hite ?? 0);

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

    /**
     * Validasi field katalog untuk proses simpan dan pembaruan.
     */
    private function validateCatalog(Request $request, ?int $ignoreId = null): array
    {
        $uniqueTitleRule = 'required|string|max:255|unique:catalog,judul';
        if ($ignoreId !== null) {
            $uniqueTitleRule .= ',' . $ignoreId;
        }

        return $request->validate([
            'judul'          => $uniqueTitleRule,
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
            'jumlah'         => 'nullable|string|max:255',
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
            'hite'           => 'nullable|integer|min:0',
            'cover'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'cover_belakang' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'img'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'soft_file'      => 'nullable|file|max:5120',
        ]);
    }

    /**
     * Buat slug unik agar tidak bentrok dengan data katalog yang sudah ada.
     */
    private function generateUniqueSlug(string $judul, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($judul) ?: 'katalog';
        $slug = $baseSlug;
        $counter = 2;

        while (
            Catalog::where('slug', $slug)
                ->when($ignoreId !== null, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
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