<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ulasan', function (Blueprint $table) {
            $table->id(); // Primary Key ID ulasan
            $table->unsignedBigInteger('id_catalog'); // Relasi ke tabel catalog
            $table->string('nama', 255);
            $table->text('ulasan');
            $table->string('stars', 255); // Menyimpan rating/bintang
            $table->string('status', 255)->default('Pending'); // Status awal Pending
            $table->timestamps();

            // Definisi Foreign Key ke tabel catalog
            $table->foreign('id_catalog')->references('id')->on('catalog')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ulasan');
    }
};