<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriProject;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriProjectController extends Controller
{
    public function index()
    {
        $kategoriProjects = KategoriProject::latest()->get();
        return view('admin.kategori-project.index', compact('kategoriProjects'));
    }

    public function create()
    {
        return view('admin.kategori-project.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:kategori_project,title',
        ]);

        KategoriProject::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
        ]);

        return redirect()->route('admin.kategori-project.index')->with('success', 'Kategori Portofolio berhasil ditambahkan!');
    }

    public function edit(KategoriProject $kategoriProject)
    {
        return view('admin.kategori-project.edit', compact('kategoriProject'));
    }

    public function update(Request $request, KategoriProject $kategoriProject)
    {
        $request->validate([
            'title' => 'required|unique:kategori_project,title,' . $kategoriProject->id,
        ]);

        $kategoriProject->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
        ]);

        return redirect()->route('admin.kategori-project.index')->with('success', 'Kategori Portofolio berhasil diperbarui!');
    }

    public function destroy(KategoriProject $kategoriProject)
    {
        $kategoriProject->delete();

        return redirect()->route('admin.kategori-project.index')->with('success', 'Kategori Portofolio berhasil dihapus!');
    }
}