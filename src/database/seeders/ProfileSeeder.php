<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Profile::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'Rizqi Bagas Wicaksono',
                'tagline' => 'Web Developer',
                'bio' => 'Seorang web developer yang passionate dalam membangun aplikasi web yang user-friendly dan scalable. Memiliki pengalaman dalam menggunakan Laravel, PHP, dan modern frontend technologies.',
                'email' => 'rizqi@example.com',
                'github' => 'https://github.com/GaassXX/dompetkuu-2026.git',
                'linkedin' => 'https://linkedin.com',
                'years_experience' => 1,
                'total_projects' => 5,
                'availability' => 'Available for work',
                'skills' => ['PHP', 'Laravel', 'Filament', 'HTML', 'CSS', 'JavaScript', 'Tailwind CSS', 'MySQL'],
            ]
        );
    }
}
