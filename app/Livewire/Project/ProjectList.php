<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class ProjectList extends Component
{
    use WithPagination;

    protected $listeners = ['projectCreated', 'projectUpdated', 'projectDeleted'];

    public function projectCreated()
    {
        $this->dispatch('notify', 'Project created successfully!');
    }

    public function projectUpdated()
    {
        $this->dispatch('notify', 'Project updated successfully!');
    }

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
