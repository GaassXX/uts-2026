<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable()->after('title');
            $table->string('thumbnail')->nullable()->after('slug');
            $table->text('solution')->nullable()->after('problem_analysis');
            $table->json('features')->nullable()->after('solution');
            $table->string('flowchart')->nullable()->after('diagram');
            $table->string('erd_diagram')->nullable()->after('flowchart');
            $table->string('use_case')->nullable()->after('erd_diagram');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'slug', 'thumbnail', 'solution',
                'features', 'flowchart', 'erd_diagram', 'use_case',
            ]);
        });
    }
};
