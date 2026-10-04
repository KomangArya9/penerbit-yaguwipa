<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pengaturan', function (Blueprint $table) {
            $table->text('profile_quote')->nullable()->after('profile_title');
        });

        DB::table('pengaturan')->where('id', 1)->update([
            'profile_quote' => 'Menghubungkan gagasan dengan dunia melalui publikasi yang berkualitas dan berintegritas.',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengaturan', function (Blueprint $table) {
            $table->dropColumn('profile_quote');
        });
    }
};
