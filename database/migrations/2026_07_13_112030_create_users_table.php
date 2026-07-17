<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('username', 100);
            $table->string('password', 255);
            $table->string('nama', 255);
            $table->string('level', 50);
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};