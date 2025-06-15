<?php

namespace App\Livewire\Task;

use App\Models\Task;
use App\Models\Project;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TaskAddedNotification;
use App\Notifications\TaskCreatedNotification;

class CreateTask extends ModalComponent
{
    public $projectId;
    public $project;
    public $title;
    public $description;
    public $status = 'todo';
    public $priority = 'medium';
    public $due_date;
    public $assignee_id;

    public function mount($project)
    {
        $this->projectId = $project;
        $this->project = Project::findOrFail($project);
    }

    protected $rules = [
        'title' => 'required|min:3',
        'description' => 'required',
        'status' => 'required|in:todo,in_progress,done',
        'priority' => 'required|in:high,medium,low',
        'due_date' => 'nullable|date|after:today',
        'assignee_id' => 'nullable|exists:users,id'
    ];

    public function store()
    {
        $this->validate();

        $task = Task::create([
            'title' => $this->title,
            'description' => $this->description,
            'due_date' => $this->due_date,
            'status' => $this->status,
            'priority' => $this->priority,
            'project_id' => $this->projectId,
            'assignee_id' => $this->assignee_id,
        ]);

        $creator = Auth::user();
        $team = $creator->currentTeam;

        if ($team) {
            $usersToNotify = $team->allUsers()->where('id', '!=', $creator->id);

            // Notify all relevant users
            Notification::send($usersToNotify, new TaskCreatedNotification($task));

            // Optionally, notify the creator as well if they want to see their own actions
            Notification::send($creator, new TaskCreatedNotification($task));
        }

        $this->dispatch('task-created')->to('task.task-kanban-board');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.task.create-task');
    }
}
