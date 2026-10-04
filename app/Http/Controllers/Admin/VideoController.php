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
        // Sanitize source (otomatis ekstrak URL jika mem-paste embed code <iframe>, atau tambahkan https:// jika kurang)
        $source = trim($request->source ?? '');
        if (preg_match('/src=["\']([^"\']+)["\']/', $source, $matches)) {
            $source = $matches[1];
        }
        if (!preg_match('~^https?://~i', $source) && !empty($source)) {
            $source = 'https://' . $source;
        }
        $request->merge(['source' => $source]);

        $request->validate([
            'date' => 'required|date',
            'title' => 'required|string|max:100',
            'content' => 'nullable|string',
            'source' => 'required|string|max:255',
            'status' => 'required|in:Show,Hide',
            'hit' => 'nullable|integer|min:0',
        ]);

        Video::create([
            'date' => $request->date,
            'title' => $request->title,
            'content' => $request->content ?? '',
            'source' => $request->source,
            'hit' => $request->hit ?? 0,
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
        // Sanitize source
        $source = trim($request->source ?? '');
        if (preg_match('/src=["\']([^"\']+)["\']/', $source, $matches)) {
            $source = $matches[1];
        }
        if (!preg_match('~^https?://~i', $source) && !empty($source)) {
            $source = 'https://' . $source;
        }
        $request->merge(['source' => $source]);

        $request->validate([
            'date' => 'required|date',
            'title' => 'required|string|max:100',
            'content' => 'nullable|string',
            'source' => 'required|string|max:255',
            'status' => 'required|in:Show,Hide',
            'hit' => 'nullable|integer|min:0',
        ]);

        $video = Video::findOrFail($id);
        $video->update([
            'date' => $request->date,
            'title' => $request->title,
            'content' => $request->content ?? '',
            'source' => $request->source,
            'hit' => $request->hit ?? $video->hit,
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
