<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'problem_analysis',
        'tech_stack',
        'diagram',
        'github_url',
        'demo_url',
        'status',
        'progress',
        'is_final_project'
    ];

    protected $casts = [
        'tech_stack' => 'array',
        'is_final_project' => 'boolean',
    ];
}
