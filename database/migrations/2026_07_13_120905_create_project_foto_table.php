<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('project_foto', function (Blueprint $table) {
            $table->integer('id_project');
            $table->text('img');
        });
    }

    public function down()
    {
        Schema::dropIfExists('project_foto');
    }
};