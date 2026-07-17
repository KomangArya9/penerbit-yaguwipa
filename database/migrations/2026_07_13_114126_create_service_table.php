<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('service', function (Blueprint $table) {
            $table->text('title');
            $table->text('short');
            $table->text('content');
            $table->text('icon');
            $table->text('img');
            $table->string('status', 50);
            $table->string('slug', 255);
            $table->text('url');
        });
    }

    public function down()
    {
        Schema::dropIfExists('service');
    }
};