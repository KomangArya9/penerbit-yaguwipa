<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AuthorController extends Controller
{
    // Menampilkan daftar penulis di halaman Admin
    public function index()
    {
        $authors = Author::latest()->paginate(10);
        return view('admin.authors.index', compact('authors'));
    }

    // Menyimpan data penulis baru (dari form user publik)
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->nama);
        $data['status'] = 'pending'; // Status awal saat user kirim form

        // Handle upload foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/authors'), $filename);
            $data['foto'] = 'uploads/authors/' . $filename;
        }

        Author::create($data);

        return redirect()->back()->with('success', 'Data penulis berhasil dikirim dan menunggu persetujuan admin.');
    }

    // Menampilkan halaman edit data penulis untuk Admin
    public function edit($id)
    {
        $author = Author::findOrFail($id);
        return view('admin.authors.edit', compact('author'));
    }

    // Menyimpan perubahan data penulis dari panel Admin
    public function update(Request $request, $id)
    {
        $author = Author::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'institusi' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'nomor' => 'nullable|string|max:50',
            'social_media' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'keahlian' => 'nullable|string|max:255',
            'profile' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->nama);

       // Handle upload foto baru jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama di storage jika ada
            if ($author->foto && Storage::disk('public')->exists($author->foto)) {
                Storage::disk('public')->delete($author->foto);
            }

            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Simpan foto baru ke folder storage/app/public/authors
            $path = $file->storeAs('authors', $filename, 'public');
            $data['foto'] = $path;
        }

        $author->update($data);

        return redirect()->route('admin.authors.index')->with('success', 'Data penulis berhasil diperbarui.');
    }

    // Mengubah status author secara cepat (Show / Hide / Pending)
    public function updateStatus(Request $request, $id)
    {
        $author = Author::findOrFail($id);
        $author->status = $request->status; 
        $author->save();

        return redirect()->back()->with('success', 'Status penulis berhasil diperbarui.');
    }

    // Menghapus data penulis
    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        
        // Hapus file foto fisik jika ada
        if ($author->foto && file_exists(public_path($author->foto))) {
            unlink(public_path($author->foto));
        }

        $author->delete();

        return redirect()->back()->with('success', 'Data penulis berhasil dihapus.');
    }
}