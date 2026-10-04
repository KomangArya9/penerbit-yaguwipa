<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultMenus = [
            [
                'title' => 'Home',
                'url' => '/',
                'status' => 'Show',
                'urutan' => 1,
                'parent_id' => null,
            ],
            [
                'title' => 'Profile',
                'url' => 'profile',
                'status' => 'Show',
                'urutan' => 2,
                'parent_id' => null,
            ],
            [
                'title' => 'Program',
                'url' => 'program',
                'status' => 'Show',
                'urutan' => 3,
                'parent_id' => null,
            ],
            [
                'title' => 'Portofolio',
                'url' => 'portofolio',
                'status' => 'Show',
                'urutan' => 4,
                'parent_id' => null,
            ],
            [
                'title' => 'Penulis',
                'url' => 'penulis',
                'status' => 'Show',
                'urutan' => 5,
                'parent_id' => null,
            ],
            [
                'title' => 'Katalog',
                'url' => 'katalog',
                'status' => 'Show',
                'urutan' => 6,
                'parent_id' => null,
            ],
            [
                'title' => 'Partners & Client',
                'url' => 'partners',
                'status' => 'Show',
                'urutan' => 7,
                'parent_id' => null,
            ],
            [
                'title' => 'News & Events',
                'url' => 'news',
                'status' => 'Show',
                'urutan' => 8,
                'parent_id' => null,
            ],
        ];

        // Clean existing placeholder menu and insert complete set
        Menu::truncate();

        foreach ($defaultMenus as $menu) {
            Menu::create($menu);
        }
    }
}
