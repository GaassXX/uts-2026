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
        'skills',
        'years_experience',
        'total_projects',
        'availability',
    ];

    protected $casts = [
        'skills' => 'array',
    ];
}
