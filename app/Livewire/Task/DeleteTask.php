<?php

namespace App\Livewire\Task;

use App\Models\Task;
use LivewireUI\Modal\ModalComponent;

class DeleteTask extends ModalComponent
{
    public $task;

    public function mount(Task $task)
    {
        $this->task = $task;
    }

    public function delete()
    {
        $this->task->delete();
        $this->dispatch('task-deleted');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.task.delete-task');
    }
}
