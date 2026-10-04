<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; 
use App\Models\Pengaturan;         
use App\Models\Menu;
use App\Models\Media;
use App\Models\KontakKami;
use App\Models\Program;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Membuat variabel $setting dan $menus bisa diakses di SEMUA halaman (views)
        View::composer('*', function ($view) {
            $view->with('setting', Pengaturan::first());
            $view->with('kontakList', KontakKami::all());
            $view->with('menus', Menu::with(['children' => function($q) {
                $q->where('status', 'Show')->orderBy('urutan', 'asc');
            }])->where('status', 'Show')->whereNull('parent_id')->orderBy('urutan', 'asc')->get());
        });
    }
}