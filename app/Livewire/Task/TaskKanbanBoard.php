<?php

namespace App\Livewire\Task;

use Livewire\Component;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TaskStatusChangedNotification;

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
                $task = Task::find($item['value']);
                $oldStatus = $task->status;

                if ($oldStatus !== $status) {
                    // Update the task
                    $task->update([
                        'order' => $item['order'],
                        'status' => $status
                    ]);

                    // Get the current user who moved the task
                    $movedBy = Auth::user();

                    // Get all users in the current team
                    $team = $movedBy->currentTeam;
                    if ($team) {
                        // Get all users in the current team, excluding the mover
                        $usersToNotify = $team->allUsers()->where('id', '!=', $movedBy->id);

                        // Create notification with formatted status
                        $notification = new TaskStatusChangedNotification(
                            $task,
                            $this->statuses[$oldStatus] ?? $oldStatus,
                            $this->statuses[$status] ?? $status,
                            $movedBy
                        );

                        // Notify all relevant users
                        Notification::send($usersToNotify, $notification);

                        // Optionally, notify the mover as well
                        Notification::send($movedBy, $notification);
                    }
                } else {
                    // If only the order changed, just update the order
                    $task->update(['order' => $item['order']]);
                }
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
