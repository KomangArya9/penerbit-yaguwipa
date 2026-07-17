<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('blog', function (Blueprint $table) {
            $table->date('date');
            $table->string('title', 500);
            $table->string('slug', 500);
            $table->text('img');
            $table->string('caption', 500);
            $table->text('content');
            $table->enum('status', ['Show', 'Hide']);
            $table->integer('hit');
            $table->text('tags');
            $table->text('keyword');
            $table->string('id_category', 255);
        });
    }

    public function down()
    {
        Schema::dropIfExists('blog');
    }
};