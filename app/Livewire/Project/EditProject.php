<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;
use App\Notifications\ProjectUpdatedNotification;
use Illuminate\Support\Facades\Notification;

class EditProject extends ModalComponent
{
    public $projectId;
    public $title;
    public $description;
    public $start_date;
    public $end_date;
    public $project;

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
        $this->project = $project;
    }

    public function update()
    {
        $this->validate();

        $this->project->update([
            'title' => $this->title,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ]);

        $updater = Auth::user();
        $team = $updater->currentTeam;

        if ($team) {
            $usersToNotify = $team->allUsers()->where('id', '!=', $updater->id);
            Notification::send($usersToNotify, new ProjectUpdatedNotification($this->project, $updater->name));
            Notification::send($updater, new ProjectUpdatedNotification($this->project, $updater->name));
        }

        $this->dispatch('project-updated')->to('project.project-list');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.project.edit-project');
    }
}
