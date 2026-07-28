<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('clinet', function (Blueprint $table) {
            $table->id(); // Primary Key otomatis (ID)
            $table->text('title');
            $table->text('img');
            $table->string('status', 50);
            $table->text('url');
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('clinet');
    }
};