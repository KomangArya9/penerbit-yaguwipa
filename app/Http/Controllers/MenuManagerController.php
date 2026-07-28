<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuManagerController extends Controller
{
    public function index()
    {
        $data_menu = Menu::orderBy('urutan', 'asc')->get();

        return view('admin.menu.index', compact('data_menu'));
    }

    public function create()
    {
        return view('admin.menu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'status' => 'required',
        ]);

        Menu::create($request->all());

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin.menu.edit', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'status' => 'required',
        ]);

        $menu = Menu::findOrFail($id);
        $menu->update($request->all());

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil dihapus!');
    }

    // Menampilkan halaman struktur menu (Sorting Data)
    public function sorting()
    {
        // Ambil hanya menu utama (yang tidak punya parent) beserta anak menunya
        $menus = Menu::whereNull('parent_id')->orderBy('urutan', 'asc')->get();
        return view('admin.menu.sorting', compact('menus'));
    }
}