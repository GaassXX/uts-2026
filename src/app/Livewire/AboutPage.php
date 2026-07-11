<?php

namespace App\Livewire;

use App\Models\Experience;
use App\Models\Profile;
use Livewire\Component;

class AboutPage extends Component
{
    public function render()
    {
        $profile = Profile::first();
        $experiences = Experience::orderBy('order')->get();

        return view('livewire.about-page', compact('profile', 'experiences'))
            ->layout('layouts.app');
    }
}
