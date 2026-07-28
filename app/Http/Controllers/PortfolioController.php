<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\KategoriProject;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil seluruh data kategori untuk tombol filter dinamis di view
        $categories = KategoriProject::all();

        // 2. Query data project: hanya ambil yang statusnya 'Show', urutkan dari terbaru, dan sertakan relasi (TANPA get/paginate dulu)
        $query = Project::with(['kategoriProject', 'fotos'])->where('status', 'Show')->latest();

        // 3. Jika pengunjung mengklik salah satu kategori, filter project berdasarkan slug kategori tersebut
        if ($request->has('category') && $request->category != '') {
            $categorySlug = $request->category;
            $query->whereHas('kategoriProject', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        // 4. Batasi 8 project per halaman menggunakan pagination di akhir query
        $projects = $query->paginate(8)->appends($request->query());

        // 5. Kirim data categories dan projects ke view portofolio
        return view('portofolio', compact('categories', 'projects'));
    }

    public function show($slug)
    {
        // Ambil data project berdasarkan slug, sertakan relasi kategori dan fotonya
        $project = Project::with(['kategoriProject', 'fotos'])->where('slug', $slug)->where('status', 'Show')->firstOrFail();

        // Opsional: Tambah jumlah hit/dilihat setiap kali halaman detail dibuka
        $project->increment('hit');

        // Kirim data ke view detail
        return view('portofolio-detail', compact('project'));
    }
}