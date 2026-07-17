<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('catalog', function (Blueprint $table) {
            $table->string('judul', 255);
            $table->string('penulis', 255);
            $table->string('editor', 255);
            $table->string('penerbit', 255);
            $table->string('i_penulis', 255);
            $table->string('i_editor', 255);
            $table->string('jenis', 255);
            $table->string('kategori', 255);
            $table->string('bidang', 255);
            $table->string('isbn', 255);
            $table->string('issn', 255);
            $table->string('ukuran', 255);
            $table->string('jumlah', 255);
            $table->string('terbit', 255);
            $table->string('kondisi', 255);
            $table->string('ketersediaan', 255);
            $table->string('keterangan', 255);
            $table->text('deskripsi');
            $table->text('info');
            $table->string('harga', 255);
            $table->string('penjual', 255);
            $table->string('wa', 255);
            $table->string('alamat', 255);
            $table->string('bank', 255);
            $table->string('norek', 255);
            $table->text('soft_file');
            $table->string('cover', 255);
            $table->string('img', 255);
            $table->enum('status', ['Show', 'Hide']);
            $table->string('date', 255);
            $table->text('cover_belakang');
            $table->string('ktp', 255);
            $table->string('diskon', 255);
            $table->string('slug', 255);
            $table->integer('hite');
        });
    }

    public function down()
    {
        Schema::dropIfExists('catalog');
    }
};