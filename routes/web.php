    <?php

    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\Session;
    use Illuminate\Support\Facades\App;

    // 1. Middleware untuk menerapkan bahasa dari session di setiap request
    // Ini memastikan pilihan bahasa Anda tetap aktif di halaman mana pun
    App::setLocale(Session::get('locale', 'id'));

    // 2. Route untuk pindah bahasa
    Route::get('/lang/{locale}', function ($locale) {
        if (in_array($locale, ['en', 'id'])) {
            Session::put('locale', $locale);
        }
        return redirect()->back();
    })->name('lang.switch');

    // 3. Route utama aplikasi
    Route::get('/', function () {
        return view('home');
    });

    Route::get('/', function () {
        return view('home');
    })->name('home');
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
    Route::get('/program', function () {
        return view('program');
    })->name('program');
    Route::get('/portofolio', function () {
        return view('portofolio');
    })->name('portofolio');
    Route::get('/penulis', function () {
        return view('penulis');
    })->name('penulis');
    Route::get('/katalog', function () {
        return view('katalog');
    })->name('katalog');
    Route::get('/partners', function () {
        return view('partner');
    })->name('partners');
    Route::get('/news', function () {
        return view('news');
    })->name('news');
    Route::get('/contact', function () {
        return view('contact');
    });