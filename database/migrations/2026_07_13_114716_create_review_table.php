<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('review', function (Blueprint $table) {
            $table->string('nama', 255);
            $table->text('review');
            $table->string('starts', 10);
            $table->string('status', 255);
            $table->string('pekerjaan', 255);
        });
    }

    public function down()
    {
        Schema::dropIfExists('review');
    }
};