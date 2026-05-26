<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;

class ProjectDetail extends Component
{
    #[Locked]
    public Project $project;

    #[Computed]
    public function relatedProjects()
    {
        return Project::where('id', '!=', $this->project->id)
            ->where(function ($q) {
                $q->where('status', $this->project->status)
                  ->orWhereJsonContains('tech_stack', optional($this->project->tech_stack)[0] ?? '');
            })
            ->limit(3)
            ->get();
    }

    public function render()
    {
        return view('livewire.project-detail', [
            'project'         => $this->project,
            'relatedProjects' => $this->relatedProjects,
        ])->layout('layouts.app');
    }
}
