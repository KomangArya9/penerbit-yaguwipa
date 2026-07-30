<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientPublicController extends Controller
{
    public function index()
    {
        // Hanya ambil data client yang statusnya 'Show'
        $clients = Client::where('status', 'Show')->get();
        
        // Mengarahkan ke file view partner milik user
        return view('partner', compact('clients'));
    }
}