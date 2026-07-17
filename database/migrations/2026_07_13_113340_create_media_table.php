<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->text('title');
            $table->text('url');
        });
    }

    public function down()
    {
        Schema::dropIfExists('media');
    }
};