<?php

namespace App\Livewire\Task;

use Livewire\Component;
use App\Models\Task;
use LivewireUI\Modal\ModalComponent;

class EditTask extends ModalComponent
{
    public $task;
    public $title;
    public $description;
    public $status;
    public $priority;
    public $due_date;
    public $assignee_id;

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
        $validated = $this->validate([
            'title' => 'required|min:3',
            'description' => 'nullable',
            'status' => 'required|in:todo,in_progress,done',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'nullable|date',
            'assignee_id' => 'nullable|exists:users,id'
        ]);

        $this->task->update($validated);

        $this->dispatch('task-updated');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.task.edit-task');
    }
}
