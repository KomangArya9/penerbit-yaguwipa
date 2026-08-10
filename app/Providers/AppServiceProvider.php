<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; 
use App\Models\Pengaturan;         
use App\Models\Menu; // Tambahkan namespace model Menu

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
        // Set locale dari session di setiap request
        \App::setLocale(\Session::get('locale', 'id'));

        // Membuat variabel $setting dan $menus bisa diakses di SEMUA halaman (views)
        View::composer('*', function ($view) {
            $view->with('setting', Pengaturan::first());
            $view->with('menus', Menu::where('status', 'Show')->orderBy('urutan', 'asc')->get());
        });
    }
}