<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Attributes\Locked;
use Livewire\Component;

class ProjectDetail extends Component
{
    #[Locked]
    public Project $project;

    public function render()
    {
        return view('livewire.project-detail', [
            'project' => $this->project,
        ])->layout('layouts.app');
    }
}
