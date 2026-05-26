<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'description',
        'problem_analysis',
        'solution',
        'features',
        'tech_stack',
        'flowchart',
        'erd_diagram',
        'use_case',
        'diagram',
        'github_url',
        'demo_url',
        'document',
        'status',
        'progress',
        'is_final_project',
    ];

    protected $casts = [
        'tech_stack'       => 'array',
        'features'         => 'array',
        'is_final_project' => 'boolean',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });

        static::updating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });
    }
}
