<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Kategori;
use App\Models\Tags;
use App\Models\Keyword;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('kategori')->latest()->get();
        return view('admin.blog.index', compact('blogs'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.blog.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_category' => 'required',
            'date'        => 'required|date',
            'title'       => 'required|string|max:500',
            'content'     => 'required',
            'img'         => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            'caption'     => 'nullable|string|max:500',
            'status'      => 'required|in:Show,Hide',
            'hit'         => 'nullable|integer',
            'tags'        => 'nullable|string',
            'keyword'     => 'nullable|string',
        ]);

        $imgPath = null;
        if ($request->hasFile('img')) {
            $imgPath = $request->file('img')->store('blog', 'public');
        }

        // Simpan data Blog (Hit bisa diinput manual oleh admin, default 0 jika kosong)
        Blog::create([
            'id_category' => $request->id_category,
            'date'        => $request->date,
            'title'       => $request->title,
            'slug'        => Str::slug($request->title),
            'content'     => $request->content,
            'img'         => $imgPath,
            'caption'     => $request->caption,
            'status'      => $request->status,
            'hit'         => $request->hit ?? 0,
            'tags'        => $request->tags,
            'keyword'     => $request->keyword,
        ]);

        // Proses otomatis simpan Tags ke tabel tags
        if ($request->filled('tags')) {
            $tagsArray = preg_split('/[;,]/', $request->tags);
            foreach ($tagsArray as $tagTitle) {
                $tagTitle = trim($tagTitle);
                if (!empty($tagTitle)) {
                    Tags::firstOrCreate(
                        ['title' => $tagTitle],
                        ['hit' => '1']
                    );
                }
            }
        }

        // Proses otomatis simpan Keyword ke tabel keyword (Diperbaiki menggunakan $keywordsArray)
        if ($request->filled('keyword')) {
            $keywordsArray = preg_split('/[,;]/', $request->keyword);
            foreach ($keywordsArray as $kwTitle) {
                $kwTitle = trim($kwTitle);
                if (!empty($kwTitle)) {
                    Keyword::firstOrCreate(
                        ['title' => $kwTitle],
                        ['hit' => '1']
                    );
                }
            }
        }

        return redirect()->route('admin.blog.index')->with('success', 'News & Events berhasil ditambahkan!');
    }

    public function edit(Blog $blog)
    {
        $kategoris = Kategori::all();
        return view('admin.blog.edit', compact('blog', 'kategoris'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'id_category' => 'required',
            'date'        => 'required|date',
            'title'       => 'required|string|max:500',
            'content'     => 'required',
            'img'         => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            'caption'     => 'nullable|string|max:500',
            'status'      => 'required|in:Show,Hide',
            'hit'         => 'nullable|integer',
            'tags'        => 'nullable|string',
            'keyword'     => 'nullable|string',
        ]);

        $imgPath = $blog->img;
        if ($request->hasFile('img')) {
            if ($blog->img && Storage::disk('public')->exists($blog->img)) {
                Storage::disk('public')->delete($blog->img);
            }
            $imgPath = $request->file('img')->store('blog', 'public');
        }

        $blog->update([
            'id_category' => $request->id_category,
            'date'        => $request->date,
            'title'       => $request->title,
            'slug'        => Str::slug($request->title),
            'content'     => $request->content,
            'img'         => $imgPath,
            'caption'     => $request->caption,
            'status'      => $request->status,
            'hit'         => $request->hit ?? $blog->hit,
            'tags'        => $request->tags,
            'keyword'     => $request->keyword,
        ]);

        // Sinkronisasi Tags saat edit
        if ($request->filled('tags')) {
            $tagsArray = preg_split('/[;,]/', $request->tags);
            foreach ($tagsArray as $tagTitle) {
                $tagTitle = trim($tagTitle);
                if (!empty($tagTitle)) {
                    Tags::firstOrCreate(
                        ['title' => $tagTitle],
                        ['hit' => '1']
                    );
                }
            }
        }

        // Sinkronisasi Keyword saat edit
        if ($request->filled('keyword')) {
            $keywordsArray = preg_split('/[,;]/', $request->keyword);
            foreach ($keywordsArray as $kwTitle) {
                $kwTitle = trim($kwTitle);
                if (!empty($kwTitle)) {
                    Keyword::firstOrCreate(
                        ['title' => $kwTitle],
                        ['hit' => '1']
                    );
                }
            }
        }

        return redirect()->route('admin.blog.index')->with('success', 'News & Events berhasil diperbarui!');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->img && Storage::disk('public')->exists($blog->img)) {
            Storage::disk('public')->delete($blog->img);
        }
        
        $blog->delete();

        return redirect()->route('admin.blog.index')->with('success', 'News & Events berhasil dihapus!');
    }
}