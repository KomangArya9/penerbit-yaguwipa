<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('video', function (Blueprint $table) {
            $table->date('date');
            $table->string('title', 100);
            $table->text('content');
            $table->string('source', 255);
            $table->integer('hit');
            $table->enum('status', ['Show', 'Hide']);
            $table->text('slug');
            $table->string('id_group', 50);
        });
    }

    public function down()
    {
        Schema::dropIfExists('video');
    }
};