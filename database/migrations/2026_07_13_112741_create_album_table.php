<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('album', function (Blueprint $table) {
            $table->string('title', 100);
            $table->text('img');
            $table->integer('hit');
            $table->text('slug');
            $table->date('date');
            $table->string('status', 50);
        });
    }

    public function down()
    {
        Schema::dropIfExists('album');
    }
};