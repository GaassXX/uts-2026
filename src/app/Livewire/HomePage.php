<?php

namespace App\Livewire;

use App\Models\Profile;
use Livewire\Attributes\Computed;
use Livewire\Component;

class HomePage extends Component
{
    #[Computed]
    public function profile(): Profile
    {
        return Profile::first() ?? new Profile;
    }

    public function render()
    {
        return view('livewire.home-page', [
            'profile' => $this->profile,
        ])->layout('layouts.app');
    }
}
