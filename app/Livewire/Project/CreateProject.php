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
            'team_id' => Auth::user()->currentTeam->id,
            'user_id' => Auth::user()->id,
        ]);

        $creator = Auth::user();
        $team = $creator->currentTeam;

        if ($team) {
            $usersToNotify = $team->allUsers()->where('id', '!=', $creator->id);

            // Notify all relevant users
            Notification::send($usersToNotify, new ProjectCreatedNotification($project));

            // Optionally, notify the creator as well if they want to see their own actions
            Notification::send($creator, new ProjectCreatedNotification($project));
        }

        $this->dispatch('projectCreated');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.project.create-project');
    }
}
