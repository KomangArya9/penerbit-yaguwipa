<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('clinet', function (Blueprint $table) {
            $table->text('title');
            $table->text('img');
            $table->string('status', 50);
            $table->text('url');
        });
    }

    public function down()
    {
        Schema::dropIfExists('clinet');
    }
};