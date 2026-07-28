<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album; 
use App\Models\Review;

class ProfileController extends Controller
{
    public function index()
    {
        // Mengambil album dengan status Show
        $albums = Album::where('status', 'Show')->latest()->take(5)->get();

        // Mengambil review yang statusnya 'Show' untuk ditampilkan di Reader Perspectives
        $reviews = Review::where('status', 'Show')->latest()->get();

        return view('profile', compact('albums', 'reviews'));
    }

    public function allPhotos()
    {
        $albums = Album::where('status', 'Show')->latest()->paginate(8);

        return view('all-photos', compact('albums'));
    }
}