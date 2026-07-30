<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramPublicController extends Controller
{
    public function index()
    {
        // Sesuaikan dengan ENUM database: 'Show'
        $programs = Program::where('status', 'Show')->latest()->get(); 

        return view('program', compact('programs'));
    }
}