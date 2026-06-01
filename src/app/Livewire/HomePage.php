<?php

namespace App\Livewire;

use App\Models\Profile;
use App\Models\Project;
use App\Models\Experience;
use Livewire\Component;

class HomePage extends Component
{
    public function render()
    {
        $profile     = Profile::first();
        $projects    = Project::latest()->take(3)->get();
        $experiences = Experience::orderBy('order')->get();

        return view('livewire.home-page', compact('profile', 'projects', 'experiences'))
            ->layout('layouts.app');
    }
}
