<?php

namespace App\Livewire\Task;

use Livewire\Component;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class TaskKanbanBoard extends Component
{
    public $projectId;
    public $project;
    public $tasks;
    public $statuses = [
        'todo' => 'To Do',
        'in_progress' => 'In Progress',
        'done' => 'Done'
    ];

    public function mount($project)
    {
        $this->projectId = $project;
        $this->project = Project::findOrFail($project);
        $this->loadTasks();
    }

    public function loadTasks()
    {
        $this->tasks = Task::query()
            ->where('project_id', $this->projectId)
            ->orderBy('order')
            ->get();
    }

    public function getGroupedTasksProperty()
    {
        return $this->tasks->groupBy('status');
    }

    public function updateTaskOrder($orderedGroups)
    {
        foreach ($orderedGroups as $group) {
            $status = $group['value'];
            foreach ($group['items'] as $item) {
                Task::where('id', $item['value'])->update([
                    'order' => $item['order'],
                    'status' => $status
                ]);
            }
        }

        $this->loadTasks();
    }

    public function updateGroupOrder($orderedIds)
    {
        foreach ($orderedIds as $index => $id) {
            Task::where('id', $id)->update(['order' => $index]);
        }

        $this->loadTasks();
    }

    #[On('task-created')]
    public function handleTaskCreated()
    {
        $this->loadTasks();
    }

    #[On('task-updated')]
    public function handleTaskUpdated()
    {
        $this->loadTasks();
    }

    #[On('task-deleted')]
    public function handleTaskDeleted()
    {
        $this->loadTasks();
    }

    public function render()
    {
        return view('livewire.task.task-kanban-board');
    }
}
