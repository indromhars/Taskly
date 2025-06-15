<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class TaskEditedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $task;
    protected $editedBy;
    protected $changes;

    /**
     * Create a new notification instance.
     */
    public function __construct(Task $task, $editedBy, array $changes)
    {
        $this->task = $task;
        $this->editedBy = $editedBy;
        $this->changes = $changes;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the database representation of the notification.
     */
    public function toDatabase($notifiable): array
    {
        $changesText = collect($this->changes)->map(function ($change, $field) {
            return "{$field}: {$change['old']} → {$change['new']}";
        })->join(', ');

        return [
            'task_id' => $this->task->id,
            'task_title' => $this->task->title,
            'project_id' => $this->task->project_id,
            'edited_by_id' => $this->editedBy->id,
            'edited_by_name' => $this->editedBy->name,
            'changes' => $this->changes,
            'message' => $this->editedBy->name . ' updated task "' . $this->task->title . '": ' . $changesText,
            'type' => 'task_edited'
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Task \'' . $this->task->title . '\' in project \'' . ($this->task->project->title ?? 'N/A') . '\' has been edited by ' . $this->editedBy->name . '.',
            'task_id' => $this->task->id,
            'task_title' => $this->task->title,
            'project_id' => $this->task->project_id,
            'project_title' => $this->task->project->title ?? 'N/A',
        ];
    }
}
