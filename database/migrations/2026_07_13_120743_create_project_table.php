<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('project', function (Blueprint $table) {
            $table->string('date', 20);
            $table->string('title', 500);
            $table->text('img');
            $table->text('content');
            $table->enum('status', ['Show', 'Hide']);
            $table->integer('hit');
            $table->text('url');
            $table->text('lokasi');
            $table->string('slug', 255);
            $table->string('id_category', 255);
            $table->string('id_service', 255);
        });
    }

    public function down()
    {
        Schema::dropIfExists('project');
    }
};