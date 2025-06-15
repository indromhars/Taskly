<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskDeletedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public Task $task;
    public string $deleterName;

    /**
     * Create a new notification instance.
     */
    public function __construct(Task $task, string $deleterName)
    {
        $this->task = $task;
        $this->deleterName = $deleterName;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the database representation of the notification.
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'message' => 'Task \'' . $this->task->title . '\' has been deleted by ' . $this->deleterName . '.',
            'task_id' => $this->task->id,
            'task_title' => $this->task->title,
            'project_id' => $this->task->project_id,
            'project_title' => $this->task->project->title,
            'deleted_by_user_name' => $this->deleterName,
            'type' => 'task_deleted'
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
            'message' => 'Task \'' . $this->task->title . '\' has been deleted by ' . $this->deleterName . '.',
            'task_id' => $this->task->id,
            'task_title' => $this->task->title,
        ];
    }
}
