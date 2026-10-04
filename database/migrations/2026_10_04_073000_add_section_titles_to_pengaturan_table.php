<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pengaturan', function (Blueprint $table) {
            // Home Page Titles & Subtitles
            $table->string('home_program_title')->nullable()->after('team');
            $table->string('home_about_title')->nullable()->after('home_program_title');
            $table->string('home_katalog_title')->nullable()->after('home_about_title');
            $table->string('home_testimoni_title')->nullable()->after('home_katalog_title');
            $table->text('home_testimoni_subtitle')->nullable()->after('home_testimoni_title');

            // Program Page
            $table->string('program_title')->nullable()->after('home_testimoni_subtitle');
            $table->text('program_subtitle')->nullable()->after('program_title');

            // Portofolio Page
            $table->string('portofolio_title')->nullable()->after('program_subtitle');
            $table->text('portofolio_subtitle')->nullable()->after('portofolio_title');

            // Penulis & Katalog
            $table->string('penulis_title')->nullable()->after('portofolio_subtitle');
            $table->string('katalog_title')->nullable()->after('penulis_title');

            // Partner & Klien
            $table->string('partner_title')->nullable()->after('katalog_title');
            $table->text('partner_subtitle')->nullable()->after('partner_title');

            // News & Events
            $table->string('news_title')->nullable()->after('partner_subtitle');
            $table->text('news_subtitle')->nullable()->after('news_title');
            $table->string('news_other_title')->nullable()->after('news_subtitle');

            // Profile Page
            $table->string('profile_photo_title')->nullable()->after('news_other_title');
            $table->string('profile_video_title')->nullable()->after('profile_photo_title');
            $table->string('profile_review_title')->nullable()->after('profile_video_title');
            $table->string('profile_form_title')->nullable()->after('profile_review_title');
            $table->string('profile_map_title')->nullable()->after('profile_form_title');

            // Media All Pages
            $table->string('all_photos_title')->nullable()->after('profile_map_title');
            $table->string('all_videos_title')->nullable()->after('all_photos_title');
            $table->text('all_videos_subtitle')->nullable()->after('all_videos_title');

            // Footer
            $table->string('footer_credit')->nullable()->after('all_videos_subtitle');
        });

        // Initialize default values for the existing row
        DB::table('pengaturan')->where('id', 1)->update([
            'home_program_title' => 'Program Utama Kami',
            'home_about_title' => 'Menyebarluaskan Ilmu, Membangun Literasi',
            'home_katalog_title' => 'Katalog Unggulan',
            'home_testimoni_title' => 'Ulasan & Testimoni',
            'home_testimoni_subtitle' => 'Kepercayaan para penulis dan pembaca menjadi motivasi kami untuk terus menghadirkan layanan penerbitan terbaik',
            'program_title' => 'Program Kerja Kami',
            'program_subtitle' => 'Dedikasi kami untuk menyediakan ekosistem yang menyeluruh bagi para akademisi, penulis, dan pembaca.',
            'portofolio_title' => 'Portofolio',
            'portofolio_subtitle' => 'Rekam jejak karya dan proyek yang telah diselesaikan.',
            'penulis_title' => 'Penulis Kami',
            'katalog_title' => 'Katalog Buku',
            'partner_title' => 'Partner & Klien',
            'partner_subtitle' => 'Kami bangga bekerja sama dengan berbagai institusi dan mitra strategis dalam memajukan dunia literasi. Kolaborasi ini memperkuat komitmen kami pada penyebaran ilmu pengetahuan.',
            'news_title' => 'News & Events',
            'news_subtitle' => 'Ikuti perkembangan terbaru, berita industri, dan jadwal acara literasi dari Penerbit Yaguwipa.',
            'news_other_title' => 'Berita Lainnya',
            'profile_photo_title' => 'Photo Archive',
            'profile_video_title' => 'Documentary & Film',
            'profile_review_title' => 'Reader Perspectives',
            'profile_form_title' => 'Share Your Experience',
            'profile_map_title' => 'Lokasi Kantor Kami',
            'all_photos_title' => 'Semua Foto Album',
            'all_videos_title' => 'Semua Koleksi Video & Dokumenter',
            'all_videos_subtitle' => 'Daftar lengkap dokumentasi video dan film yang telah dipublikasikan.',
            'footer_credit' => 'Designed by Yaguwipa Tech Team',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengaturan', function (Blueprint $table) {
            $table->dropColumn([
                'home_program_title',
                'home_about_title',
                'home_katalog_title',
                'home_testimoni_title',
                'home_testimoni_subtitle',
                'program_title',
                'program_subtitle',
                'portofolio_title',
                'portofolio_subtitle',
                'penulis_title',
                'katalog_title',
                'partner_title',
                'partner_subtitle',
                'news_title',
                'news_subtitle',
                'news_other_title',
                'profile_photo_title',
                'profile_video_title',
                'profile_review_title',
                'profile_form_title',
                'profile_map_title',
                'all_photos_title',
                'all_videos_title',
                'all_videos_subtitle',
                'footer_credit',
            ]);
        });
    }
};
