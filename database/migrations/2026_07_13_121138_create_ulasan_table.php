<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ulasan', function (Blueprint $table) {
            $table->string('nama', 255);
            $table->text('ulasan');
            $table->string('stars', 255);
            $table->string('status', 255);
            $table->integer('id_catalog');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ulasan');
    }
};