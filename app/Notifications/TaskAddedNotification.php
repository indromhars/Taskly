<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskAddedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $task;
    protected $addedBy;

    /**
     * Create a new notification instance.
     */
    public function __construct(Task $task, $addedBy)
    {
        $this->task = $task;
        $this->addedBy = $addedBy;
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

    public function toDatabase($notifiable): array
    {
        return [
            'task_id' => $this->task->id,
            'task_title' => $this->task->title,
            'project_id' => $this->task->project_id,
            'added_by_id' => $this->addedBy->id,
            'added_by_name' => $this->addedBy->name,
            'message' => $this->addedBy->name . ' added a new task: "' . $this->task->title . '"',
            'type' => 'task_added'
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
            //
        ];
    }
}
