<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskStatusChangedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $task;
    protected $oldStatus;
    protected $newStatus;
    protected $movedBy;

    public function __construct(Task $task, string $oldStatus, string $newStatus, $movedBy)
    {
        $this->task = $task;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
        $this->movedBy = $movedBy;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'type' => 'task_status_changed',
            'task_id' => $this->task->id,
            'task_title' => $this->task->title,
            'old_status' => $this->oldStatus,
            'new_status' => $this->newStatus,
            'project_id' => $this->task->project_id,
            'moved_by_id' => $this->movedBy->id,
            'moved_by_name' => $this->movedBy->name,
            'message' => $this->movedBy->name . ' moved task "' . $this->task->title . '" from "' . $this->oldStatus . '" to "' . $this->newStatus . '"'
        ];
    }
}
