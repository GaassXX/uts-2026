<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;

class ProjectDetail extends Component
{
    public Project $project;

    public function render()
    {
        return view('livewire.project-detail', [
            'project' => $this->project,
        ])->layout('layouts.app');
    }
}
