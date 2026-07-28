<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CatalogPublicController extends Controller
{
    public function index(Request $request)
    {
        $categories = Catalog::where('status', 'Show')->select('kategori')->distinct()->pluck('kategori');
        $query = Catalog::where('status', 'Show');

        if ($request->has('kategori')) {
            $query->whereIn('kategori', $request->kategori);
        }

        if ($request->has('tahun')) {
            if ($request->tahun == '2026') {
                $query->whereYear('created_at', 2026);
            } elseif ($request->tahun == '2020-2023') {
                $query->whereBetween(DB::raw('YEAR(created_at)'), [2020, 2023]);
            } elseif ($request->tahun == 'sebelum_2020') {
                $query->whereYear('created_at', '<', 2020);
            }
        }

        $catalogs = $query->latest()->paginate(9)->withQueryString();

        return view('katalog', compact('catalogs', 'categories'));
    }

    public function show($id)
    {
        $catalog = Catalog::where('status', 'Show')->findOrFail($id);
        return view('show', compact('catalog'));
    }

    public function storePublic(Request $request)
    {
        try {
            // Validasi dasar
            $request->validate([
                'judul' => 'required|string|max:255',
                'penulis' => 'required|string|max:255',
            ]);

            // Pemetaan data secara menyeluruh (Mendukung semua jenis penulisan name di form)
            $data = [
                'judul' => $request->judul ?? $request->input('Judul'),
                'penulis' => $request->penulis ?? $request->input('Penulis'),
                'editor' => $request->editor ?? $request->input('Editor'),
                'penerbit' => $request->penerbit ?? $request->input('Penerbit'),

                'i_penulis' => $request->i_penulis ?? $request->institusi_penulis ?? $request->input('Institusi Penulis'),
                'i_editor' => $request->i_editor ?? $request->institusi_editor ?? $request->input('Institusi Editor'),

                'jenis' => $request->jenis ?? $request->jenis_terbitan ?? $request->input('Jenis Terbitan'),
                'kategori' => $request->kategori ?? $request->input('Kategori'),
                'bidang' => $request->bidang ?? $request->bidang_ilmu ?? $request->input('Bidang Ilmu'),

                'isbn' => $request->isbn ?? $request->input('ISBN'),
                'issn' => $request->issn ?? $request->input('ISSN'),
                'ukuran' => $request->ukuran ?? $request->input('Ukuran'),

                'jumlah' => $request->jumlah ?? $request->jumlah_halaman ?? $request->input('Jumlah Halaman'),
                'terbit' => $request->terbit ?? $request->bulan_tahun_terbit ?? $request->tahun_terbit ?? $request->input('Bulan & Tahun Terbit'),

                'kondisi' => $request->kondisi ?? $request->kondisi_terbitan ?? $request->input('Kondisi Terbitan'),
                'ketersediaan' => $request->ketersediaan ?? $request->input('Ketersediaan'),
                'keterangan' => $request->keterangan ?? $request->input('Keterangan'),
                'deskripsi' => $request->deskripsi ?? $request->input('Deskripsi'),

                'info' => $request->info ?? $request->info_tambahan ?? $request->input('Info Tambahan'),
                'harga' => $request->harga ?? $request->input('Harga'),
                'diskon' => $request->diskon ?? $request->harga_diskon ?? $request->input('Harga Diskon'),

                'penjual' => $request->penjual ?? $request->penjual_penyedia ?? $request->input('Penjual/Penyedia'),
                'wa' => $request->wa ?? $request->no_wa ?? $request->input('No WA'),
                'alamat' => $request->alamat ?? $request->input('Alamat'),
                'ktp' => $request->ktp ?? $request->no_ktp ?? $request->input('No KTP'),
                'bank' => $request->bank ?? $request->nama_bank ?? $request->input('Nama Bank'),
                'norek' => $request->norek ?? $request->no_rekening ?? $request->input('Nomor Rekening'),

                'slug' => Str::slug($request->judul ?? $request->input('Judul')) . '-' . uniqid(),
                'status' => 'Pending',
            ];

            // Handle File Uploads
            if ($request->hasFile('cover')) {
                $data['cover'] = $request->file('cover')->store('catalog/cover', 'public');
            }
            if ($request->hasFile('cover_belakang')) {
                $data['cover_belakang'] = $request->file('cover_belakang')->store('catalog/cover_belakang', 'public');
            }
            if ($request->hasFile('img')) {
                $data['img'] = $request->file('img')->store('catalog/img', 'public');
            }
            if ($request->hasFile('soft_file')) {
                $data['soft_file'] = $request->file('soft_file')->store('catalog/soft_file', 'public');
            }

            $catalog = Catalog::create($data);

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Katalog berhasil diunggah!',
                    'data' => $catalog
                ], 200);
            }

            return redirect()->back()->with('success', 'Katalog berhasil diunggah!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal.',
                    'errors' => $e->errors(),
                ], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error server: ' . $e->getMessage(),
                ], 500);
            }
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $catalog = Catalog::findOrFail($id);

        $request->validate([
            'judul' => 'nullable|string|max:255',
            'penulis' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $data = [
            'judul' => $request->judul ?? $request->input('Judul'),
            'penulis' => $request->penulis ?? $request->input('Penulis'),
            'editor' => $request->editor ?? $request->input('Editor'),
            'penerbit' => $request->penerbit ?? $request->input('Penerbit'),

            'i_penulis' => $request->i_penulis ?? $request->institusi_penulis ?? $request->input('Institusi Penulis'),
            'i_editor' => $request->i_editor ?? $request->institusi_editor ?? $request->input('Institusi Editor'),

            'jenis' => $request->jenis ?? $request->jenis_terbitan ?? $request->input('Jenis Terbitan'),
            'kategori' => $request->kategori ?? $request->input('Kategori'),

            'bidang' => $request->bidang ?? $request->bidang_ilmu ?? $request->input('Bidang Ilmu'),

            'isbn' => $request->isbn ?? $request->input('ISBN'),
            'issn' => $request->issn ?? $request->input('ISSN'),
            'ukuran' => $request->ukuran ?? $request->input('Ukuran'),

            'jumlah' => $request->jumlah ?? $request->jumlah_halaman ?? $request->input('Jumlah Halaman'),
            'terbit' => $request->terbit ?? $request->bulan_tahun_terbit ?? $request->tahun_terbit ?? $request->input('Bulan & Tahun Terbit'),

            'kondisi' => $request->kondisi ?? $request->kondisi_terbitan ?? $request->input('Kondisi Terbitan'),
            'ketersediaan' => $request->ketersediaan ?? $request->input('Ketersediaan'),
            'keterangan' => $request->keterangan ?? $request->input('Keterangan'),
            'deskripsi' => $request->deskripsi ?? $request->input('Deskripsi'),

            'info' => $request->info ?? $request->info_tambahan ?? $request->input('Info Tambahan'),

            'harga' => $request->harga ?? $request->input('Harga'),

            'diskon' => $request->diskon ?? $request->harga_diskon ?? $request->input('Harga Diskon'),

            'penjual' => $request->penjual ?? $request->penjual_penyedia ?? $request->input('Penjual/Penyedia'),

            'wa' => $request->wa ?? $request->no_wa ?? $request->input('No WA'),

            'alamat' => $request->alamat ?? $request->input('Alamat'),
            'ktp' => $request->ktp ?? $request->no_ktp ?? $request->input('No KTP'),
            'bank' => $request->bank ?? $request->nama_bank ?? $request->input('Nama Bank'),
            'norek' => $request->norek ?? $request->no_rekening ?? $request->input('Nomor Rekening'),

            'slug' => Str::slug($request->judul ?? $request->input('Judul')),
            'status' => $request->status ?? $request->input('Status') ?? $catalog->status,
            'hite' => $request->hite ?? $request->input('Hit') ?? $catalog->hite,
        ];

        if ($request->hasFile('cover_depan') || $request->hasFile('Cover Depan')) {
            if ($catalog->cover && Storage::disk('public')->exists($catalog->cover)) {
                Storage::disk('public')->delete($catalog->cover);
            }
            $file = $request->file('cover_depan') ?? $request->file('Cover Depan');
            $data['cover'] = $file->store('catalog/cover', 'public');
        }

        if ($request->hasFile('cover_belakang') || $request->hasFile('Cover Belakang')) {
            if ($catalog->cover_belakang && Storage::disk('public')->exists($catalog->cover_belakang)) {
                Storage::disk('public')->delete($catalog->cover_belakang);
            }
            $file = $request->file('cover_belakang') ?? $request->file('Cover Belakang');
            $data['cover_belakang'] = $file->store('catalog/cover_belakang', 'public');
        }

        if ($request->hasFile('daftar_isi') || $request->hasFile('Daftar Isi (Img)')) {
            if ($catalog->img && Storage::disk('public')->exists($catalog->img)) {
                Storage::disk('public')->delete($catalog->img);
            }
            $file = $request->file('daftar_isi') ?? $request->file('Daftar Isi (Img)');
            $data['img'] = $file->store('catalog/img', 'public');
        }

        $catalog->update($data);

        return redirect()->route('catalog.show', $catalog->id)
            ->with('success', 'Data katalog berhasil diperbarui!');
    }
}