<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blog', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('title', 500);
            $table->string('slug', 500);
            $table->string('img')->nullable();
            $table->string('caption', 500)->nullable();
            $table->text('content');
            $table->enum('status', ['Show', 'Hide'])->default('Show');
            $table->integer('hit')->default(0);
            $table->text('tags')->nullable();
            $table->text('keyword')->nullable();
            $table->unsignedBigInteger('id_category'); // Relasi ke tabel kategori
            $table->timestamps();

            // Foreign key ke tabel kategori yang sudah dibuat sebelumnya
            $table->foreign('id_category')->references('id')->on('kategori')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog');
    }
};