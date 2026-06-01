<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->json('skill_percentages')->nullable()->after('skills');
            $table->text('about_detail')->nullable()->after('bio');
            $table->string('cv_url')->nullable()->after('about_detail');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn(['skill_percentages', 'about_detail', 'cv_url']);
        });
    }
};
