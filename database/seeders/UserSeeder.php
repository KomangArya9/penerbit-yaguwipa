<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan data lama dihapus agar tidak duplikat
        User::truncate();

        User::create([
            'nama'     => 'Penerbit Yaguwipa',
            'username' => 'penerbityaguwipa',
            'password' => Hash::make('yaguwipa2026'),
            'level'    => 'admin',
        ]);
    }
}