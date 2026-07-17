<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kontak_kami', function (Blueprint $table) {
            $table->text('kontak');
            $table->text('title');
            $table->text('type');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kontak_kami');
    }
};