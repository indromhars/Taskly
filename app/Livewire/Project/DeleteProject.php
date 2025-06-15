<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;
use App\Notifications\ProjectDeletedNotification;
use Illuminate\Support\Facades\Notification;

class DeleteProject extends ModalComponent
{
    public $projectId;
    public $title;
    public $project;

    public function mount(Project $project)
    {
        $this->projectId = $project->id;
        $this->title = $project->title;
        $this->project = $project;
    }

    public function delete()
    {
        if ($this->project) {
            $this->project->delete();

            $deleter = Auth::user();
            $team = $deleter->currentTeam;

            if ($team) {
                $usersToNotify = $team->allUsers()->where('id', '!=', $deleter->id);
                Notification::send($usersToNotify, new ProjectDeletedNotification($this->project, $deleter->name));
                Notification::send($deleter, new ProjectDeletedNotification($this->project, $deleter->name));
            }
        }

        $this->dispatch('project-deleted')->to('project.project-list');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.project.delete-project');
    }
}
