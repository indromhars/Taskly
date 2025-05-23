<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class EditProject extends ModalComponent
{
    public $projectId;
    public $title;
    public $description;
    public $start_date;
    public $end_date;

    protected $rules = [
        'title' => 'required|min:3',
        'description' => 'required',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
    ];

    public function mount(Project $project)
    {
        $this->projectId = $project->id;
        $this->title = $project->title;
        $this->description = $project->description;
        $this->start_date = $project->start_date->format('Y-m-d');
        $this->end_date = $project->end_date->format('Y-m-d');
    }

    public function update()
    {
        $this->validate();

        $project = Project::find($this->projectId);
        $project->update([
            'title' => $this->title,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'team_id' => Auth::user()->currentTeam->id,
            'user_id' => Auth::user()->id,
        ]);

        $this->dispatch('projectUpdated');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.project.edit-project');
    }
}
