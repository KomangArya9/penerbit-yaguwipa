<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::latest()->get();
        return view('admin.video.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.video.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'title' => 'required|string|max:100',
            'content' => 'required',
            'source' => 'required|string|max:255',
            'status' => 'required|in:Show,Hide',
        ]);

        Video::create([
            'date' => $request->date,
            'title' => $request->title,
            'content' => $request->content,
            'source' => $request->source,
            'hit' => 0,
            'status' => $request->status,
            'slug' => Str::slug($request->title),
        ]);

        return redirect()->route('admin.video.index')->with('success', 'Video berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $video = Video::findOrFail($id);
        return view('admin.video.edit', compact('video'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'title' => 'required|string|max:100',
            'content' => 'required',
            'source' => 'required|string|max:255',
            'status' => 'required|in:Show,Hide',
        ]);

        $video = Video::findOrFail($id);
        $video->update([
            'date' => $request->date,
            'title' => $request->title,
            'content' => $request->content,
            'source' => $request->source,
            'status' => $request->status,
            'slug' => Str::slug($request->title),
        ]);

        return redirect()->route('admin.video.index')->with('success', 'Video berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();

        return redirect()->route('admin.video.index')->with('success', 'Video berhasil dihapus!');
    }

    public function allVideos()
    {
        $videos = Video::where('status', 'Show')->latest()->paginate(8);
        return view('videos-all', compact('videos'));
    }
}
