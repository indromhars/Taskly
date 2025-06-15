<?php

namespace App\Notifications;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
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
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Project Updated')
            ->line('Project "' . $this->project->title . '" has been updated.')
            ->line('Updated by: ' . $this->updaterName)
            ->action('View Project', url('/projects/' . $this->project->id))
            ->line('Thank you for using our application!');
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
            'type' => 'project_updated'
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
