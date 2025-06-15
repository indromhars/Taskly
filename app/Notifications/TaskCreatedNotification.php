<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public Task $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'message' => 'A new task \'' . $this->task->title . '\' has been created.',
            'task_id' => $this->task->id,
            'task_title' => $this->task->title,
            'project_id' => $this->task->project_id,
            'project_title' => $this->task->project->title,
            'type' => 'task_created'
        ];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'A new task \'' . $this->task->title . '\' has been created.',
            'task_id' => $this->task->id,
            'task_title' => $this->task->title,
        ];
    }
}
