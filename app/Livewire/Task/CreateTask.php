<?php

namespace App\Livewire\Task;

use App\Models\Task;
use App\Models\Project;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TaskAddedNotification;

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

    public function create()
    {
        $this->validate();

        $task = Task::create([
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'priority' => $this->priority,
            'due_date' => $this->due_date,
            'assignee_id' => $this->assignee_id,
            'project_id' => $this->projectId,
            'order' => Task::where('project_id', $this->projectId)
                ->where('status', $this->status)
                ->count()
        ]);

        // Dispatch notification to relevant team members
        $adder = Auth::user();
        $team = $adder->currentTeam;

        if ($team) {
            // Get all users in the current team, excluding the adder
            $usersToNotify = $team->allUsers()->where('id', '!=', $adder->id);

            // Notify all relevant users
            Notification::send($usersToNotify, new TaskAddedNotification($task, $adder->name));

            // Optionally, notify the adder as well if they want to see their own actions
            Notification::send($adder, new TaskAddedNotification($task, $adder->name));
        }

        $this->dispatch('task-created');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.task.create-task');
    }
}
