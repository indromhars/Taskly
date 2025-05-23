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
        return view('livewire.project.project-list', [
            'projects' => Project::where('team_id', Auth::user()->currentTeam->id)
                ->where('user_id', Auth::user()->id)
                ->latest()
                ->paginate(10)
        ]);
    }
}
