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

    public function mount(Project $project)
    {
        $this->projectId = $project->id;
        $this->title = $project->title;
    }

    public function delete()
    {
        $project = Project::find($this->projectId);
        if ($project) {
            $project->delete();

            $deleter = Auth::user();
            $team = $deleter->currentTeam;

            if ($team) {
                $usersToNotify = $team->allUsers()->where('id', '!=', $deleter->id);

                Notification::send($usersToNotify, new ProjectDeletedNotification($project, $deleter->name));

                Notification::send($deleter, new ProjectDeletedNotification($project, $deleter->name));
            }
        }

        $this->dispatch('projectDeleted');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.project.delete-project');
    }
}
