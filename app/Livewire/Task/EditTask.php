<?php

namespace App\Livewire\Task;

use Livewire\Component;
use App\Models\Task;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TaskUpdatedNotification;

class EditTask extends ModalComponent
{
    public $task;
    public $title;
    public $description;
    public $status;
    public $priority;
    public $due_date;
    public $assignee_id;

    public $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'status' => 'required|string',
        'priority' => 'required|string',
        'due_date' => 'nullable|date',
        'assignee_id' => 'nullable|exists:users,id',
    ];

    public function mount(Task $task)
    {
        $this->task = $task;
        $this->title = $task->title;
        $this->description = $task->description;
        $this->status = $task->status;
        $this->priority = $task->priority;
        $this->due_date = $task->due_date ? $task->due_date->format('Y-m-d') : null;
        $this->assignee_id = $task->assignee_id;
    }

    public function update()
    {
        $this->validate();

        $this->task->update([
            'title' => $this->title,
            'description' => $this->description,
            'due_date' => $this->due_date,
            'status' => $this->status,
            'priority' => $this->priority,
            'assignee_id' => $this->assignee_id,
        ]);

        $updater = Auth::user();
        $team = $updater->currentTeam;

        if ($team) {
            $usersToNotify = $team->allUsers()->where('id', '!=', $updater->id);

            Notification::send($usersToNotify, new TaskUpdatedNotification($this->task, $updater->name));
            Notification::send($updater, new TaskUpdatedNotification($this->task, $updater->name));
        }

        $this->dispatch('task-updated')->to('task.task-kanban-board');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.task.edit-task');
    }
}
