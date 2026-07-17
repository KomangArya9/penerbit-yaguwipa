<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('pengaturan', function (Blueprint $table) {
        $table->string('company', 255);
        $table->string('address', 255);
        $table->string('phone', 255);
        $table->string('fax', 255);
        $table->string('email', 255);
        $table->string('website', 255);
        $table->text('map');
        $table->text('script');
        $table->text('intro');
        $table->string('cek', 5);
        $table->text('url_popup');
        $table->string('header', 255);
        $table->text('favicon');
        $table->string('popup', 255);
        $table->text('background');
        $table->string('copyright', 255);
        $table->text('meta_title');
        $table->text('meta_description');
        $table->text('seo');
        $table->text('team');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturan');
    }
};
