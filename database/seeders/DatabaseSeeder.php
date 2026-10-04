<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Memanggil UserSeeder agar data admin yang kita buat 
        // sebelumnya di file UserSeeder.php bisa masuk ke database.
        $this->call([
            UserSeeder::class,
            MenuSeeder::class,
        ]);
    }
}