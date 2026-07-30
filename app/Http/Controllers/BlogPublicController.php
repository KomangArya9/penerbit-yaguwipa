<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Kategori;
use App\Models\Tags;
use Illuminate\Http\Request;

class BlogPublicController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil Berita Trending
        $trending = Blog::where('status', 'Show')->orderBy('hit', 'desc')->first();

        // 2. Ambil kategori & tags
        $categories = Kategori::all();
        $tagsList = Tags::all();

        // 3. Query utama
        $query = Blog::where('status', 'Show');

        // Filter Kategori (Pastikan nama kolom 'id_category' atau 'kategori_id' sesuai database Anda)
        if ($request->filled('category')) {
            $query->where('id_category', $request->category);
        }

        // Perbaikan Filter Tags agar berfungsi optimal
        if ($request->filled('tag')) {
            $tag = $request->tag;
            // Jika kolom tags di database berupa string biasa (misal: "literasi, pendidikan")
            $query->where('tags', 'LIKE', "%{$tag}%");

            // CATATAN: Jika Anda menggunakan relasi Many-to-Many untuk tags, 
            // ganti baris di atas dengan: $query->whereHas('tags', function($q) use ($tag) { $q->where('title', $tag); });
        }

        // Hindari duplikat berita trending di grid bawah HANYA JIKA sedang tidak memfilter sesuatu
        if ($trending && !$request->filled('category') && !$request->filled('tag')) {
            $query->where('id', '!=', $trending->id);
        }

        $blogs = $query->latest('date')->paginate(6)->withQueryString();

        return view('news', compact('trending', 'blogs', 'categories', 'tagsList'));
    }

    public function show($slug)
    {
        // Ambil detail berita & tambahkan hit (views) secara otomatis
        $blog = Blog::where('slug', $slug)->where('status', 'Show')->firstOrFail();
        $blog->increment('hit');

        // Berita terkait berdasarkan kategori yang sama
        $relatedBlogs = Blog::where('status', 'Show')
            ->where('id_category', $blog->id_category)
            ->where('id', '!=', $blog->id)
            ->limit(3)
            ->get();

        return view('news-detail', compact('blog', 'relatedBlogs'));
    }
}