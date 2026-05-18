<?php

namespace App\Livewire;

use App\Models\Profile;
use Livewire\Component;

class HomePage extends Component
{
    public function render()
    {
        $profile = Profile::first();
        return view('livewire.home-page', compact('profile'))
            ->layout('layouts.app');
    }
}
