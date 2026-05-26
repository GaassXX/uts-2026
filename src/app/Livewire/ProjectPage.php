<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;

class ProjectPage extends Component
{
    #[Url(as: 'q')]
    public string $search = '';

    #[Url]
    public string $status = '';

    #[Computed]
    public function projects()
    {
        return Project::query()
            ->when($this->search, fn ($q) => $q->where('title', 'like', "%{$this->search}%"))
            ->when($this->status, fn ($q) => $q->where('status', $this->status))
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.project-page', [
            'projects' => $this->projects,
        ])->layout('layouts.app');
    }
}
