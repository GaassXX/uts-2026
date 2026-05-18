<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;

class ProjectPage extends Component
{
    public function render()
    {
        $projects = Project::latest()->get();
        return view('livewire.project-page', compact('projects'))
            ->layout('layouts.app');
    }
}
