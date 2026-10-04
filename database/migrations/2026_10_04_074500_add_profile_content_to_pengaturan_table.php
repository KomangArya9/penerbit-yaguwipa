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
            $table->string('profile_badge')->nullable()->after('profile_map_title');
            $table->string('profile_title')->nullable()->after('profile_badge');
            $table->text('profile_content')->nullable()->after('profile_title');
            $table->text('home_about_desc')->nullable()->after('home_about_title');
        });

        $currentUrlPopup = DB::table('pengaturan')->where('id', 1)->value('url_popup');

        DB::table('pengaturan')->where('id', 1)->update([
            'profile_badge' => 'PENERBIT TEPERCAYA',
            'profile_title' => 'Tentang Penerbit Yaguwipa',
            'profile_content' => $currentUrlPopup ?? "Selamat datang di Penerbit YAGUWIPA\n\nPenerbit YAGUWIPA berperan aktif menyebarluaskan hasil riset, IPTEKS, dan karya sastra sebagai bentuk gerakan literasi riset dan humaniora. Dengan fokus pada penyebaran ilmu pengetahuan, teknologi, dan kreativitas, kami mempersembahkan koleksi yang beragam untuk memenuhi kebutuhan para pembaca dari berbagai latar belakang. Dari buku akademis yang mendalam hingga karya sastra yang menghibur, kami menyediakan platform bagi para penulis untuk berbagi ide dan pengetahuan mereka dengan dunia.\n\nTim kami berpengalaman dalam bidang editorial, desain, dan pemasaran. Kami berupaya untuk menghadirkan karya-karya yang relevan, informatif, dan inspiratif. Kami juga bangga menjadi wadah bagi peneliti, ilmuwan, dan penulis kreatif untuk mempublikasikan hasil karya mereka dan berkontribusi pada perkembangan pengetahuan dan kebudayaan global. Informasi terkait syarat penerbitan bisa dilihat pada Informasi Penerbitan.\n\nMari bergabung dengan kami dalam menjelajahi dunia literasi yang tak terbatas, setiap halaman buku membawa kita pada petualangan baru dan wawasan yang mendalam. Temukanlah karya-karya yang memperkaya pikiran dan memperluas pandangan Anda, hanya di Penerbit YAGUWIPA. Hasil karya penulis dapat ditemukan pada Catalog Terbitan",
            'home_about_desc' => 'Penerbit YAGUWIPA hadir sebagai penerbit kredibel yang berkomitmen menyebarluaskan hasil riset, IPTEKS, dan karya sastra bermutu tinggi guna memajukan literasi dan kebudayaan bangsa.',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengaturan', function (Blueprint $table) {
            $table->dropColumn([
                'profile_badge',
                'profile_title',
                'profile_content',
                'home_about_desc',
            ]);
        });
    }
};
