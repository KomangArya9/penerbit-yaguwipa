<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_foto', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke kolom 'id' di tabel 'project'
            $table->foreignId('project_id')->constrained('project')->onDelete('cascade');
            $table->string('img'); // Untuk menyimpan path/nama file foto galeri
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_foto');
    }
};