<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Blog;
use App\Models\Project;
use App\Models\Review;
use App\Models\Ulasan;
use App\Models\Author;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'totalCatalog'        => Catalog::count(),
            'pendingCatalog'      => Catalog::where('status', 'Pending')->count(),
            'totalBlog'           => Blog::count(),
            'totalProject'        => Project::count(),
            'totalReview'         => Review::count(),
            'pendingReview'       => Review::where('status', 'Pending')->count(),
            'totalUlasan'         => Ulasan::count(),
            'pendingUlasan'       => Ulasan::where('status', 'Pending')->count(),
            'totalAuthor'         => Author::count(),
            // Support both singular and plural keys for backward compatibility
            'totalAuthors'        => Author::count(),
            'totalReviews'        => Review::count(),
        ];

        $recentCatalogs = Catalog::latest()->take(5)->get();
        $recentReviews = Review::latest()->take(5)->get();
        
        return view('admin.dashboard', compact('data', 'recentCatalogs', 'recentReviews'));
    }
}