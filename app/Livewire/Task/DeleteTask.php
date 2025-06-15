<?php

namespace App\Livewire\Task;

use App\Models\Task;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TaskDeletedNotification;

class DeleteTask extends ModalComponent
{
    public $task;

    public function mount(Task $task)
    {
        $this->task = $task;
    }

    public function delete()
    {
        if ($this->task) {
        $this->task->delete();

            $deleter = Auth::user();
            $team = $deleter->currentTeam;

            if ($team) {
                $usersToNotify = $team->allUsers()->where('id', '!=', $deleter->id);

                Notification::send($usersToNotify, new TaskDeletedNotification($this->task, $deleter->name));

                Notification::send($deleter, new TaskDeletedNotification($this->task, $deleter->name));
            }
        }

        $this->dispatch('task-deleted')->to('task.task-kanban-board');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.task.delete-task');
    }
}
