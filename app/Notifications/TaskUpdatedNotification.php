<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskUpdatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public Task $task;
    public string $updaterName;

    public function __construct(Task $task, string $updaterName)
    {
        $this->task = $task;
        $this->updaterName = $updaterName;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'message' => 'Task \'' . $this->task->title . '\' has been updated by ' . $this->updaterName . '.',
            'task_id' => $this->task->id,
            'task_title' => $this->task->title,
            'project_id' => $this->task->project_id,
            'project_title' => $this->task->project->title,
            'updated_by_user_name' => $this->updaterName,
            'type' => 'task_updated'
        ];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Task \'' . $this->task->title . '\' has been updated by ' . $this->updaterName . '.',
            'task_id' => $this->task->id,
            'task_title' => $this->task->title,
        ];
    }
}
