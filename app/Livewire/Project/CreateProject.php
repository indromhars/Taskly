<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;
use App\Notifications\ProjectCreatedNotification;
use Illuminate\Support\Facades\Notification;

class CreateProject extends ModalComponent
{
    public $title;
    public $description;
    public $start_date;
    public $end_date;
    public $team_id;

    protected $rules = [
        'title' => 'required|min:3',
        'description' => 'required',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
    ];

    public function store()
    {
        $this->validate();

        $project = Project::create([
            'title' => $this->title,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'team_id' => $this->team_id,
        ]);

        $creator = Auth::user();
        $team = $creator->currentTeam;

        if ($team) {
            $usersToNotify = $team->allUsers()->where('id', '!=', $creator->id);
            Notification::send($usersToNotify, new ProjectCreatedNotification($project, $creator->name));
            Notification::send($creator, new ProjectCreatedNotification($project, $creator->name));
        }

        $this->dispatch('project-created')->to('project.project-list');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.project.create-project');
    }
}
