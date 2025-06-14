<?php

namespace App\Notifications;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class ProjectDeletedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public Project $project;
    public string $deleterName;

    /**
     * Create a new notification instance.
     */
    public function __construct(Project $project, string $deleterName)
    {
        $this->project = $project;
        $this->deleterName = $deleterName;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the database representation of the notification.
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'message' => 'Project \'' . $this->project->title . '\' has been deleted by ' . $this->deleterName . '.',
            'project_id' => $this->project->id,
            'project_title' => $this->project->title,
            'deleted_by_user_id' => Auth::id(),
            'deleted_by_user_name' => $this->deleterName,
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
            'message' => 'Project \'' . $this->project->title . '\' has been deleted by ' . $this->deleterName . '.',
            'project_id' => $this->project->id,
            'project_title' => $this->project->title,
        ];
    }
}
