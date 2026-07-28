<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('catalog', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 255);
            $table->string('penulis', 255)->nullable();
            $table->string('editor', 255)->nullable();
            $table->string('penerbit', 255)->nullable();
            $table->string('i_penulis', 255)->nullable(); // Institusi Penulis
            $table->string('i_editor', 255)->nullable();  // Institusi Editor
            $table->string('jenis', 255)->nullable();     // Jenis Terbitan
            $table->string('kategori', 255)->nullable();
            $table->string('bidang', 255)->nullable();    // Bidang Ilmu
            $table->string('isbn', 255)->nullable();
            $table->string('issn', 255)->nullable();
            $table->string('ukuran', 255)->nullable();
            $table->string('jumlah', 255)->nullable();    // Jumlah Halaman
            $table->string('terbit', 255)->nullable();    // Bulan & Tahun Terbit
            $table->string('kondisi', 255)->nullable();
            $table->string('ketersediaan', 255)->nullable();
            $table->string('keterangan', 255)->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('info')->nullable();             // Info Tambahan
            $table->string('harga', 255)->nullable();
            $table->string('penjual', 255)->nullable();
            $table->string('wa', 255)->nullable();
            $table->string('alamat', 255)->nullable();
            $table->string('bank', 255)->nullable();
            $table->string('norek', 255)->nullable();
            $table->text('soft_file')->nullable();
            $table->string('cover', 255)->nullable();
            $table->string('img', 255)->nullable();
            $table->enum('status', ['Show', 'Hide'])->default('Show');
            $table->string('date', 255)->nullable();
            $table->text('cover_belakang')->nullable();
            $table->string('ktp', 255)->nullable();
            $table->string('diskon', 255)->nullable();
            $table->string('slug', 255)->unique();
            $table->integer('hite')->default(0);          // Hit / Dilihat
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('catalog');
    }
};