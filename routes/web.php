<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GeneralSettingsController;
use App\Http\Controllers\MenuManagerController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\KategoriProjectController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\KontakKamiController;
use App\Http\Controllers\Admin\CatalogController;
use App\Http\Controllers\Admin\UlasanController;
use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\PasswordController;


use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicReviewController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\AuthorPublicController;
use App\Http\Controllers\CatalogPublicController;
use App\Http\Controllers\PublicUlasanController;
use App\Http\Controllers\ClientPublicController;
use App\Http\Controllers\BlogPublicController;
use App\Http\Controllers\ProgramPublicController;



// 1. Locale default Indonesia (konten asli dalam bahasa Indonesia)
App::setLocale('id');

// 2. [DISABLED] Route pindah bahasa sekarang menggunakan Google Translate
// Route::get('/lang/{locale}', function ($locale) {
//     if (in_array($locale, ['en', 'id'])) {
//         Session::put('locale', $locale);
//     }
//     return redirect()->back();
// })->name('lang.switch');

// 3. Route Utama / Publik
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

Route::get('/', [HomeController::class, 'index']);

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('/photos', [ProfileController::class, 'allPhotos'])->name('photos.all');
Route::get('/videos', [VideoController::class, 'allVideos'])->name('videos.all');

Route::post('/review/store', [PublicReviewController::class, 'store'])->name('review.store');

Route::get('/portofolio', [PortfolioController::class, 'index'])->name('portofolio');
Route::get('/portofolio/{slug}', [PortfolioController::class, 'show'])->name('portofolio.show');

Route::get('/penulis', [AuthorPublicController::class, 'index'])->name('authors.public');
Route::post('/penulis/store', [AuthorPublicController::class, 'store'])->name('authors.store');

Route::get('/katalog', [CatalogPublicController::class, 'index'])->name('catalog.index');
Route::get('/katalog/{catalog}', [CatalogPublicController::class, 'show'])->name('catalog.show');

// Route untuk Proses Simpan & Update Data
Route::post('/katalog/store-public', [CatalogPublicController::class, 'storePublic'])->name('catalog.store.public');
Route::put('/katalog/{book}', [CatalogPublicController::class, 'update'])->name('catalog.update');

// Route untuk Kirim Ulasan Buku Publik
Route::post('/catalog/{id}/review', [CatalogPublicController::class, 'storeReview'])->name('catalog.review.store');

Route::get('/partners', [ClientPublicController::class, 'index'])->name('partner.index');

Route::get('/news', [BlogPublicController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [BlogPublicController::class, 'show'])->name('news.show');

Route::get('/program', [ProgramPublicController::class, 'index'])->name('program');


// Route untuk Login & Logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



// 4. Route Admin yang Diproteksi (Sudah diratakan dan dibersihkan dari duplikasi)
Route::prefix('admin')->middleware(['auth'])->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // General Settings
    Route::get('/pengaturan/general', [GeneralSettingsController::class, 'edit'])->name('admin.pengaturan.general');
    Route::put('/pengaturan/general', [GeneralSettingsController::class, 'update'])->name('admin.pengaturan.update');
    Route::get('/admin/pengaturan/delete-image/{field}', [GeneralSettingsController::class, 'deleteImage'])->name('admin.pengaturan.delete.image');

    // Menu Manager Routes (Urutan yang benar: Statis di atas, dinamis/ID di bawah)
    Route::get('/pengaturan/menu', [MenuManagerController::class, 'index'])->name('admin.menu.index');
    Route::get('/pengaturan/menu/create', [MenuManagerController::class, 'create'])->name('admin.menu.create');
    Route::get('/pengaturan/menu/sorting', [MenuManagerController::class, 'sorting'])->name('admin.menu.sorting');
    Route::post('/pengaturan/menu', [MenuManagerController::class, 'store'])->name('admin.menu.store');

    Route::get('/pengaturan/menu/{id}/edit', [MenuManagerController::class, 'edit'])->name('admin.menu.edit');
    Route::put('/pengaturan/menu/{id}', [MenuManagerController::class, 'update'])->name('admin.menu.update');
    Route::delete('/pengaturan/menu/{id}', [MenuManagerController::class, 'destroy'])->name('admin.menu.destroy');


    // Client / Partners Routes (Manual untuk menghindari konflik nama)
    Route::get('/client', [ClientController::class, 'index'])->name('client.index');
    Route::get('/client/create', [ClientController::class, 'create'])->name('client.create');
    Route::post('/client', [ClientController::class, 'store'])->name('client.store');
    Route::get('/client/{id}/edit', [ClientController::class, 'edit'])->name('client.edit');
    Route::put('/client/{id}', [ClientController::class, 'update'])->name('client.update');
    Route::delete('/client/{id}', [ClientController::class, 'destroy'])->name('client.destroy');


    Route::get('/review', [AdminReviewController::class, 'index'])->name('admin.review.index');
    Route::put('/review/{id}/toggle', [AdminReviewController::class, 'toggleStatus'])->name('admin.review.toggle');
    Route::delete('/review/{id}', [AdminReviewController::class, 'destroy'])->name('admin.review.destroy');

    Route::resource('program', ProgramController::class);


    Route::get('/admin/kategori-project', [KategoriProjectController::class, 'index'])->name('admin.kategori-project.index');
    Route::get('/admin/kategori-project/create', [KategoriProjectController::class, 'create'])->name('admin.kategori-project.create');
    Route::post('/admin/kategori-project', [KategoriProjectController::class, 'store'])->name('admin.kategori-project.store');
    Route::get('/admin/kategori-project/{kategori_project}/edit', [KategoriProjectController::class, 'edit'])->name('admin.kategori-project.edit');
    Route::put('/admin/kategori-project/{kategori_project}', [KategoriProjectController::class, 'update'])->name('admin.kategori-project.update');
    Route::delete('/admin/kategori-project/{kategori_project}', [KategoriProjectController::class, 'destroy'])->name('admin.kategori-project.destroy');

    Route::resource('admin/project', ProjectController::class, ['names' => 'admin.project']);

    Route::get('admin/authors', [AuthorController::class, 'index'])->name('admin.authors.index');
    Route::get('admin/authors/{id}/edit', [AuthorController::class, 'edit'])->name('admin.authors.edit');
    Route::put('admin/authors/{id}', [AuthorController::class, 'update'])->name('admin.authors.update');
    Route::put('admin/authors/{id}/status', [AuthorController::class, 'updateStatus'])->name('admin.authors.updateStatus');
    Route::delete('admin/authors/{id}', [AuthorController::class, 'destroy'])->name('admin.authors.destroy');

    Route::get('/admin/media', [MediaController::class, 'index'])->name('admin.media.index');
    Route::get('/admin/media/create', [MediaController::class, 'create'])->name('admin.media.create');
    Route::post('/admin/media', [MediaController::class, 'store'])->name('admin.media.store');
    Route::get('/admin/media/{id}/edit', [MediaController::class, 'edit'])->name('admin.media.edit');
    Route::put('/admin/media/{id}', [MediaController::class, 'update'])->name('admin.media.update');
    Route::delete('/admin/media/{id}', [MediaController::class, 'destroy'])->name('admin.media.destroy');

    Route::get('/admin/kontak-kami', [KontakKamiController::class, 'index'])->name('admin.kontak_kami.index');
    Route::get('/admin/kontak-kami/create', [KontakKamiController::class, 'create'])->name('admin.kontak_kami.create');
    Route::post('/admin/kontak-kami', [KontakKamiController::class, 'store'])->name('admin.kontak_kami.store');
    Route::get('/admin/kontak-kami/{id}/edit', [KontakKamiController::class, 'edit'])->name('admin.kontak_kami.edit');
    Route::put('/admin/kontak-kami/{id}', [KontakKamiController::class, 'update'])->name('admin.kontak_kami.update');
    Route::delete('/admin/kontak-kami/{id}', [KontakKamiController::class, 'destroy'])->name('admin.kontak_kami.destroy');

    Route::resource('admin/catalog', CatalogController::class)->names('admin.catalog');

    Route::get('/admin/ulasan', [UlasanController::class, 'index'])->name('admin.ulasan.index');
    Route::put('/admin/ulasan/{id}/status', [UlasanController::class, 'updateStatus'])->name('admin.ulasan.updateStatus');
    Route::delete('/admin/ulasan/{id}', [UlasanController::class, 'destroy'])->name('admin.ulasan.destroy');

    Route::get('/admin/album', [AlbumController::class, 'index'])->name('admin.album.index');
    Route::get('/admin/album/create', [AlbumController::class, 'create'])->name('admin.album.create');
    Route::post('/admin/album', [AlbumController::class, 'store'])->name('admin.album.store');
    Route::get('/admin/album/{id}/edit', [AlbumController::class, 'edit'])->name('admin.album.edit');
    Route::put('/admin/album/{id}', [AlbumController::class, 'update'])->name('admin.album.update');
    Route::delete('/admin/album/{id}', [AlbumController::class, 'destroy'])->name('admin.album.destroy');

    Route::get('/admin/video', [VideoController::class, 'index'])->name('admin.video.index');
    Route::get('/admin/video/create', [VideoController::class, 'create'])->name('admin.video.create');
    Route::post('/admin/video', [VideoController::class, 'store'])->name('admin.video.store');
    Route::get('/admin/video/{id}/edit', [VideoController::class, 'edit'])->name('admin.video.edit');
    Route::put('/admin/video/{id}', [VideoController::class, 'update'])->name('admin.video.update');
    Route::delete('/admin/video/{id}', [VideoController::class, 'destroy'])->name('admin.video.destroy');

    // Route untuk Kategori News & Events
    Route::resource('admin/kategori', KategoriController::class, ['names' => 'admin.kategori']);

    // Route untuk News & Events (Blog)
    Route::resource('admin/blog', BlogController::class, ['names' => 'admin.blog']);

    // Route Ganti Password
    Route::get('/admin/password', [PasswordController::class, 'edit'])->name('admin.password.edit');
    Route::put('/admin/password', [PasswordController::class, 'update'])->name('admin.password.update');

    Route::patch('/admin/catalog/{id}/approve', [CatalogController::class, 'approve'])->name('admin.catalog.approve');
});
