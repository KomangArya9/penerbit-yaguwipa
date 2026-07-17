<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kategori_project', function (Blueprint $table) {
            $table->text('title');
            $table->string('slug', 255);
        });
    }

    public function down()
    {
        Schema::dropIfExists('kategori_project');
    }
};