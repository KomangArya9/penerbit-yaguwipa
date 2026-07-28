<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nomor')->nullable();
            $table->string('email')->nullable();
            $table->string('social_media')->nullable();
            $table->text('alamat')->nullable();
            $table->string('keahlian')->nullable();
            $table->longText('profile')->nullable(); // Untuk profil singkat
            $table->text('slug')->nullable();
            $table->enum('status', ['pending', 'show', 'hide'])->default('pending'); // Default pending saat user kirim form
            $table->text('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('authors');
    }
};