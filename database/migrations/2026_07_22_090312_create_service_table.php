<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('short')->nullable();
            $table->text('content');
            $table->text('icon');
            $table->text('img')->nullable();
            $table->string('status', 50);
            $table->string('slug', 255);
            $table->text('url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service');
    }
};  