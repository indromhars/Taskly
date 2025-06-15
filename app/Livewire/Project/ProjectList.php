<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class ProjectList extends Component
{
    use WithPagination;

    #[On('project-created')]
    public function projectCreated()
    {
        $this->dispatch('notify', 'Project created successfully!');
    }

    #[On('project-updated')]
    public function projectUpdated()
    {
        $this->dispatch('notify', 'Project updated successfully!');
    }

    #[On('project-deleted')]
    public function projectDeleted()
    {
        $this->dispatch('notify', 'Project deleted successfully!');
    }

    public function render()
    {
        $user = Auth::user();
        $teamIds = $user->teams->pluck('id');
        $projects = Project::whereIn('team_id', $teamIds)
            ->where('team_id', $user->currentTeam->id)
            ->orWhere('user_id', Auth::id())
            ->latest()
            ->paginate(9);

        return view('livewire.project.project-list', [
            'projects' => $projects,
        ])->layout('layouts.app');
    }
}
