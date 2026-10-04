<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KontakKami;
use Illuminate\Http\Request;

class KontakKamiController extends Controller
{
    public function index()
    {
        $kontakKami = KontakKami::all();
        return view('admin.kontak_kami.index', compact('kontakKami'));
    }

    public function create()
    {
        return view('admin.kontak_kami.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'  => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
            'type'   => 'required|string|in:Whatsapp,Call',
        ]);

        KontakKami::create($request->all());

        return redirect()->route('admin.kontak_kami.index')->with('success', 'Kontak berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $item = KontakKami::findOrFail($id);
        return view('admin.kontak_kami.edit', [
            'item' => $item,
            'kontakItem' => $item,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'  => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
            'type'   => 'required|string|in:Whatsapp,Call',
        ]);

        $kontakKami = KontakKami::findOrFail($id);
        $kontakKami->update($request->all());

        return redirect()->route('admin.kontak_kami.index')->with('success', 'Kontak berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kontakKami = KontakKami::findOrFail($id);
        $kontakKami->delete();

        return redirect()->route('admin.kontak_kami.index')->with('success', 'Kontak berhasil dihapus.');
    }
}