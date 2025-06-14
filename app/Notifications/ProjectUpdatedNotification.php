<?php

namespace App\Notifications;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class ProjectUpdatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public Project $project;
    public string $updaterName;

    /**
     * Create a new notification instance.
     */
    public function __construct(Project $project, string $updaterName)
    {
        $this->project = $project;
        $this->updaterName = $updaterName;
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
            'message' => 'Project \'' . $this->project->title . '\' has been updated by ' . $this->updaterName . '.',
            'project_id' => $this->project->id,
            'project_title' => $this->project->title,
            'updated_by_user_id' => Auth::id(),
            'updated_by_user_name' => $this->updaterName,
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
            'message' => 'Project \'' . $this->project->title . '\' has been updated by ' . $this->updaterName . '.',
            'project_id' => $this->project->id,
            'project_title' => $this->project->title,
        ];
    }
}
