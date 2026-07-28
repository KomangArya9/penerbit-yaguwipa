<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id(); // Membuat kolom id sebagai primary key otomatis
            $table->string('title');
            $table->string('url');
            $table->timestamps(); // Membuat kolom created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('media');
    }
};