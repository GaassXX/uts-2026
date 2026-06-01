<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name',
        'tagline',
        'bio',
        'photo',
        'email',
        'github',
        'linkedin',
        'whatsapp',
        'location',
        'instagram',
        'skills',
        'skill_percentages',
        'years_experience',
        'total_projects',
        'availability',
    ];

    protected $casts = [
        'skills' => 'array',
        'skill_percentages' => 'array',
    ];
}
