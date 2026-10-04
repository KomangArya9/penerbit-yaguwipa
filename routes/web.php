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



// 1. Route untuk pindah bahasa (kompatibilitas redirect & cookie Google Translate)
Route::get('/lang/{locale}', function ($locale) {
    $code = strtolower($locale);
    $response = redirect()->back();
    if ($code === 'id') {
        return $response->withCookie(cookie('googtrans', '', -1, '/'));
    }
    return $response->withCookie(cookie('googtrans', '/id/' . $code, 60 * 24 * 365, '/'));
})->name('lang.switch');

// 3. Route Utama / Publik
Route::get('/', [HomeController::class, 'index'])->name('home');

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


// 4. Route Admin yang Diproteksi
Route::prefix('admin')->middleware(['auth'])->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // General Settings
    Route::get('/pengaturan/general', [GeneralSettingsController::class, 'edit'])->name('admin.pengaturan.general');
    Route::put('/pengaturan/general', [GeneralSettingsController::class, 'update'])->name('admin.pengaturan.update');
    Route::get('/pengaturan/delete-image/{field}', [GeneralSettingsController::class, 'deleteImage'])->name('admin.pengaturan.delete.image');

    // Menu Manager Routes
    Route::get('/pengaturan/menu', [MenuManagerController::class, 'index'])->name('admin.menu.index');
    Route::get('/pengaturan/menu/create', [MenuManagerController::class, 'create'])->name('admin.menu.create');
    Route::get('/pengaturan/menu/sorting', [MenuManagerController::class, 'sorting'])->name('admin.menu.sorting');
    Route::put('/pengaturan/menu/sorting', [MenuManagerController::class, 'updateSorting'])->name('admin.menu.updateSorting');
    Route::post('/pengaturan/menu', [MenuManagerController::class, 'store'])->name('admin.menu.store');
    Route::patch('/pengaturan/menu/{id}/toggle', [MenuManagerController::class, 'toggleStatus'])->name('admin.menu.toggle');
    Route::get('/pengaturan/menu/{id}/edit', [MenuManagerController::class, 'edit'])->name('admin.menu.edit');
    Route::put('/pengaturan/menu/{id}', [MenuManagerController::class, 'update'])->name('admin.menu.update');
    Route::delete('/pengaturan/menu/{id}', [MenuManagerController::class, 'destroy'])->name('admin.menu.destroy');


    // Client / Partners Routes
    Route::get('/client', [ClientController::class, 'index'])->name('client.index');
    Route::get('/client/create', [ClientController::class, 'create'])->name('client.create');
    Route::post('/client', [ClientController::class, 'store'])->name('client.store');
    Route::get('/client/{id}/edit', [ClientController::class, 'edit'])->name('client.edit');
    Route::put('/client/{id}', [ClientController::class, 'update'])->name('client.update');
    Route::delete('/client/{id}', [ClientController::class, 'destroy'])->name('client.destroy');


    // Review Routes
    Route::get('/review', [AdminReviewController::class, 'index'])->name('admin.review.index');
    Route::put('/review/{id}/toggle', [AdminReviewController::class, 'toggleStatus'])->name('admin.review.toggle');
    Route::put('/review/{id}/status', [AdminReviewController::class, 'updateStatus'])->name('admin.review.updateStatus');
    Route::delete('/review/{id}', [AdminReviewController::class, 'destroy'])->name('admin.review.destroy');

    // Program Routes
    Route::resource('program', ProgramController::class);

    // Kategori Portofolio Routes
    Route::get('/kategori-project', [KategoriProjectController::class, 'index'])->name('admin.kategori-project.index');
    Route::get('/kategori-project/create', [KategoriProjectController::class, 'create'])->name('admin.kategori-project.create');
    Route::post('/kategori-project', [KategoriProjectController::class, 'store'])->name('admin.kategori-project.store');
    Route::get('/kategori-project/{kategori_project}/edit', [KategoriProjectController::class, 'edit'])->name('admin.kategori-project.edit');
    Route::put('/kategori-project/{kategori_project}', [KategoriProjectController::class, 'update'])->name('admin.kategori-project.update');
    Route::delete('/kategori-project/{kategori_project}', [KategoriProjectController::class, 'destroy'])->name('admin.kategori-project.destroy');

    // Portofolio Project Routes
    Route::resource('project', ProjectController::class, ['names' => 'admin.project']);

    // Authors / Penulis Routes
    Route::get('/authors', [AuthorController::class, 'index'])->name('admin.authors.index');
    Route::get('/authors/{id}/edit', [AuthorController::class, 'edit'])->name('admin.authors.edit');
    Route::put('/authors/{id}', [AuthorController::class, 'update'])->name('admin.authors.update');
    Route::put('/authors/{id}/status', [AuthorController::class, 'updateStatus'])->name('admin.authors.updateStatus');
    Route::delete('/authors/{id}', [AuthorController::class, 'destroy'])->name('admin.authors.destroy');

    // Media Sosial Routes
    Route::get('/media', [MediaController::class, 'index'])->name('admin.media.index');
    Route::get('/media/create', [MediaController::class, 'create'])->name('admin.media.create');
    Route::post('/media', [MediaController::class, 'store'])->name('admin.media.store');
    Route::get('/media/{id}/edit', [MediaController::class, 'edit'])->name('admin.media.edit');
    Route::put('/media/{id}', [MediaController::class, 'update'])->name('admin.media.update');
    Route::delete('/media/{id}', [MediaController::class, 'destroy'])->name('admin.media.destroy');

    // Kontak Kami Routes
    Route::get('/kontak-kami', [KontakKamiController::class, 'index'])->name('admin.kontak_kami.index');
    Route::get('/kontak-kami/create', [KontakKamiController::class, 'create'])->name('admin.kontak_kami.create');
    Route::post('/kontak-kami', [KontakKamiController::class, 'store'])->name('admin.kontak_kami.store');
    Route::get('/kontak-kami/{id}/edit', [KontakKamiController::class, 'edit'])->name('admin.kontak_kami.edit');
    Route::put('/kontak-kami/{id}', [KontakKamiController::class, 'update'])->name('admin.kontak_kami.update');
    Route::delete('/kontak-kami/{id}', [KontakKamiController::class, 'destroy'])->name('admin.kontak_kami.destroy');

    // Catalog Routes
    Route::resource('catalog', CatalogController::class)->names('admin.catalog');
    Route::patch('/catalog/{id}/approve', [CatalogController::class, 'approve'])->name('admin.catalog.approve');

    // Ulasan Buku Routes
    Route::get('/ulasan', [UlasanController::class, 'index'])->name('admin.ulasan.index');
    Route::put('/ulasan/{id}/status', [UlasanController::class, 'updateStatus'])->name('admin.ulasan.updateStatus');
    Route::delete('/ulasan/{id}', [UlasanController::class, 'destroy'])->name('admin.ulasan.destroy');

    // Album & Foto Routes
    Route::get('/album', [AlbumController::class, 'index'])->name('admin.album.index');
    Route::get('/album/create', [AlbumController::class, 'create'])->name('admin.album.create');
    Route::post('/album', [AlbumController::class, 'store'])->name('admin.album.store');
    Route::get('/album/{id}/edit', [AlbumController::class, 'edit'])->name('admin.album.edit');
    Route::put('/album/{id}', [AlbumController::class, 'update'])->name('admin.album.update');
    Route::delete('/album/{id}', [AlbumController::class, 'destroy'])->name('admin.album.destroy');

    // Video Routes
    Route::get('/video', [VideoController::class, 'index'])->name('admin.video.index');
    Route::get('/video/create', [VideoController::class, 'create'])->name('admin.video.create');
    Route::post('/video', [VideoController::class, 'store'])->name('admin.video.store');
    Route::get('/video/{id}/edit', [VideoController::class, 'edit'])->name('admin.video.edit');
    Route::put('/video/{id}', [VideoController::class, 'update'])->name('admin.video.update');
    Route::delete('/video/{id}', [VideoController::class, 'destroy'])->name('admin.video.destroy');

    // Kategori News & Events Routes
    Route::resource('kategori', KategoriController::class, ['names' => 'admin.kategori']);

    // News & Events (Blog) Routes
    Route::resource('blog', BlogController::class, ['names' => 'admin.blog']);

    // Ganti Password Routes
    Route::get('/password', [PasswordController::class, 'edit'])->name('admin.password.edit');
    Route::put('/password', [PasswordController::class, 'update'])->name('admin.password.update');
});
