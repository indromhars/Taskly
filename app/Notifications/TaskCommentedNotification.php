<?php

namespace App\Notifications;

use App\Models\Task;
use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskCommentedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $task;
    protected $comment;
    protected $commentedBy;

    /**
     * Create a new notification instance.
     */
    public function __construct(Task $task, Comment $comment, $commentedBy)
    {
        $this->task = $task;
        $this->comment = $comment;
        $this->commentedBy = $commentedBy;
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
            ->subject('New Comment on Task')
            ->line($this->commentedBy->name . ' commented on task "' . $this->task->title . '"')
            ->line('Comment: ' . $this->comment->content)
            ->action('View Task', url('/projects/' . $this->task->project_id . '/kanban'))
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
            'comment_id' => $this->comment->id,
            'comment_content' => $this->comment->content,
            'commented_by_id' => $this->commentedBy->id,
            'commented_by_name' => $this->commentedBy->name,
            'message' => $this->commentedBy->name . ' commented on task "' . $this->task->title . '": "' . $this->comment->content . '"',
            'type' => 'task_commented'
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $task = $this->comment->task;
        $project = $task->project;

        return [
            'message' => 'New comment on task \'' . ($task->title ?? 'N/A') . '\' by ' . ($this->comment->user->name ?? 'N/A') . '.',
            'comment_id' => $this->comment->id,
            'task_id' => $task->id,
            'task_title' => $task->title ?? 'N/A',
            'project_id' => $project->id ?? 'N/A',
            'project_title' => $project->title ?? 'N/A',
        ];
    }
}
