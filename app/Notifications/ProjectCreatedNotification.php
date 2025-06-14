<?php

namespace App\Notifications;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class ProjectCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public Project $project;

    /**
     * Create a new notification instance.
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
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
            'message' => 'A new project \'' . $this->project->title . '\' has been created.',
            'project_id' => $this->project->id,
            'project_title' => $this->project->title,
            'created_by_user_id' => $this->project->user_id,
            'created_by_user_name' => $this->project->user->name ?? 'N/A',
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
            // This can be used for other channels, but for database, toDatabase is preferred.
            'message' => 'A new project \'' . $this->project->title . '\' has been created.',
            'project_id' => $this->project->id,
            'project_title' => $this->project->title,
        ];
    }
}
