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
        Schema::dropIfExists('pengaturan');

        Schema::create('pengaturan', function (Blueprint $table) {
            $table->id();
            $table->string('company', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->string('fax', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('website', 255)->nullable();
            $table->text('map')->nullable();
            $table->text('script')->nullable();
            $table->text('intro')->nullable();
            $table->text('cek')->nullable();
            $table->text('url_popup')->nullable();
            $table->string('header', 255)->nullable();
            $table->text('favicon')->nullable();
            $table->string('popup', 255)->nullable();
            $table->text('background')->nullable();
            $table->string('copyright', 255)->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('seo')->nullable();
            $table->text('team')->nullable();
            $table->string('logo', 255)->nullable();
            $table->timestamps();
        });

        // Seed initial row so that settings are never completely empty
        DB::table('pengaturan')->insert([
            'company' => 'Penerbit Yaguwipa',
            'email' => 'penerbityaguwipa@gmail.com',
            'phone' => '+62 822-4752-9445',
            'address' => 'Jl. Gn. Batur, Ds. Lalanglinggah, Kec. Selemadeg Barat, Kab. Tabanan, Bali',
            'copyright' => '© 2026 Penerbit Yaguwipa - Bergerak Menerbit Karya. All Rights Reserved.',
            'team' => 'Penerbit Yaguwipa didukung oleh para penulis berdedikasi tinggi dalam menghasilkan karya literasi dan akademis berkualitas.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturan');
    }
};
