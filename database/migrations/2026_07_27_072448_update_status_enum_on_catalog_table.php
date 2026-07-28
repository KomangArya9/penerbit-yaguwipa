<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('catalog', function (Blueprint $table) {
            // Mengubah enum status agar mencakup 'Pending'
            $table->enum('status', ['Show', 'Hide', 'Pending'])->default('Pending')->change();
        });
    }

    public function down(): void
    {
        Schema::table('catalog', function (Blueprint $table) {
            // Kembalikan ke semula jika di-rollback
            $table->enum('status', ['Show', 'Hide'])->default('Show')->change();
        });
    }
};