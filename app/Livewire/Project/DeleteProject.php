<?php

namespace App\Livewire\Project;

use App\Models\Project;
use LivewireUI\Modal\ModalComponent;

class DeleteProject extends ModalComponent
{
    public $projectId;
    public $title;

    public function mount(Project $project)
    {
        $this->projectId = $project->id;
        $this->title = $project->title;
    }

    public function delete()
    {
        Project::find($this->projectId)->delete();
        $this->dispatch('projectDeleted');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.project.delete-project');
    }
}
