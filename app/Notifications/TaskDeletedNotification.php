<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class TaskDeletedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $task;
    protected $deletedBy;

    /**
     * Create a new notification instance.
     */
    public function __construct(Task $task, $deletedBy)
    {
        $this->task = $task;
        $this->deletedBy = $deletedBy;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Task Deleted')
            ->line('Task "' . $this->task->title . '" has been deleted.')
            ->line('Deleted by: ' . $this->deletedBy->name)
            ->line('Project: ' . $this->task->project->title)
            ->line('Thank you for using our application!');
    }

    /**
     * Get the database representation of the notification.
     */
    public function toDatabase($notifiable): array
    {
        return [
            'task_id' => $this->task->id,
            'task_title' => $this->task->title,
            'project_id' => $this->task->project_id,
            'project_title' => $this->task->project->title,
            'deleted_by_id' => $this->deletedBy->id,
            'deleted_by_name' => $this->deletedBy->name,
            'message' => $this->deletedBy->name . ' deleted task "' . $this->task->title . '" from project "' . $this->task->project->title . '"',
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
            'message' => 'Task \'' . $this->task->title . '\' in project \'' . ($this->task->project->title ?? 'N/A') . '\' has been deleted by ' . $this->deletedBy->name . '.',
            'task_id' => $this->task->id,
            'task_title' => $this->task->title,
            'project_id' => $this->task->project_id,
            'project_title' => $this->task->project->title ?? 'N/A',
        ];
    }
}
