<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Blog;
use App\Models\Project;
use App\Models\Ulasan;
use App\Models\Author;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'totalCatalog' => Catalog::count(),
            'totalBlog'    => Blog::count(),
            'totalProject' => Project::count(),
            'totalUlasan'  => Ulasan::count(),
            'totalAuthor' => Author::count(),
        ];
        
        return view('admin.dashboard', compact('data'));
    }
}