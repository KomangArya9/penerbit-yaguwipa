<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index()
    {
        $media = Media::all();
        return view('admin.media.index', compact('media'));
    }

    public function create()
    {
        return view('admin.media.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url',
        ]);

        Media::create($request->all());

        return redirect()->route('admin.media.index')->with('success', 'Sosial media berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $media = Media::findOrFail($id);
        return view('admin.media.edit', compact('media'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url',
        ]);

        $media = Media::findOrFail($id);
        $media->update($request->all());

        return redirect()->route('admin.media.index')->with('success', 'Sosial media berhasil diubah.');
    }

    public function destroy($id)
    {
        $media = Media::findOrFail($id);
        $media->delete();

        return redirect()->route('admin.media.index')->with('success', 'Sosial media berhasil dihapus.');
    }
}