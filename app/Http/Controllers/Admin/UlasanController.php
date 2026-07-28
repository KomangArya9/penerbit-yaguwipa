<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ulasan;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    /**
     * Menampilkan daftar ulasan.
     */
    public function index()
    {
        // Ubah variabel menjadi $ulasans (pakai 's')
        $ulasans = Ulasan::with('catalog')->latest()->get();

        return view('admin.ulasan.index', compact('ulasans'));
    }

    public function updateStatus(Request $request, $id)
    {
        $ulasan = Ulasan::findOrFail($id);
        $ulasan->status = $request->status;
        $ulasan->save();

        return redirect()->back()->with('success', 'Status ulasan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $ulasan = Ulasan::findOrFail($id);
        $ulasan->delete();

        return redirect()->back()->with('success', 'Ulasan berhasil dihapus.');
    }
}