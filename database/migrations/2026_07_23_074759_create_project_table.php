<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project', function (Blueprint $table) {
            $table->id(); // Primary key otomatis angka
            $table->string('date', 20);
            $table->string('title', 500);
            $table->text('img')->nullable();
            $table->text('content');
            $table->enum('status', ['Show', 'Hide'])->default('Show');
            $table->integer('hit')->default(0);
            $table->text('url')->nullable();
            $table->text('lokasi')->nullable();
            $table->string('slug', 255);
            
            // Relasi ke tabel kategori_project
            $table->unsignedBigInteger('kategori_project_id')->nullable();
            $table->string('id_service', 255)->nullable();

            // Foreign key constraint ke tabel kategori_project
            $table->foreign('kategori_project_id')->references('id')->on('kategori_project')->onDelete('set null');

            $table->timestamps(); // Menambahkan created_at & updated_at agar standar
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project');
    }
};