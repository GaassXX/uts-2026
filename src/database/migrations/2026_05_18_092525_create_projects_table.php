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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('problem_analysis');
            $table->json('tech_stack'); // ["Laravel", "Filament", "Docker"]
            $table->string('diagram')->nullable(); // path image ERD/Flowchart
            $table->string('github_url')->nullable();
            $table->string('demo_url')->nullable();
            $table->enum('status', ['planning', 'in_progress', 'completed'])->default('planning');
            $table->integer('progress')->default(0); // 0-100 (%)
            $table->boolean('is_final_project')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
