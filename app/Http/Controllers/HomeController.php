<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use App\Models\Menu; 
use App\Models\Program; 
use App\Models\Catalog;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil baris pertama data pengaturan
        $setting = Pengaturan::first();

        // Mengambil menu yang statusnya Show, diurutkan dari yang terkecil
        $menus = Menu::where('status', 'Show')->orderBy('urutan', 'asc')->get();

        // <-- TAMBAHKAN BARIS INI: Mengambil data program yang statusnya 'Show' -->
        $programs = Program::where('status', 'Show')->latest()->get(); 

        $catalogs = Catalog::where('status', 'Show')
                       ->orderBy('hite', 'desc')
                       ->take(4)
                       ->get();

        $reviews = Review::where('status', 'Show')->latest()->get();
                       

        // Kirim data setting, menus, DAN programs ke view home.blade.php
        return view('home', compact('setting', 'menus', 'programs', 'catalogs', 'reviews')); 
    }
}