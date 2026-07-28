<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use App\Models\Menu; 
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil baris pertama data pengaturan
        $setting = Pengaturan::first();

        // Mengambil menu yang statusnya Show, diurutkan dari yang terkecil
        $menus = Menu::where('status', 'Show')->orderBy('urutan', 'asc')->get();

        // Kirim data setting dan menus ke view home.blade.php
        return view('home', compact('setting', 'menus'));
    }
}