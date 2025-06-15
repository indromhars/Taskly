<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Project;

class ProjectUpdate extends Notification implements ShouldQueue
{
    use Queueable;

    protected $project;
    protected $updater;
    protected $updateType;

    public function __construct(Project $project, $updater, $updateType)
    {
        $this->project = $project;
        $this->updater = $updater;
        $this->updateType = $updateType;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    // Remove toMail method since we're not using email notifications
    // public function toMail($notifiable)
    // {
    //     $message = (new MailMessage)
    //         ->subject('Project Update: ' . $this->project->name)
    //         ->greeting('Hello!')
    //         ->line('There has been an update to the project "' . $this->project->name . '".')
    //         ->line('Update Type: ' . $this->updateType)
    //         ->line('Updated by: ' . $this->updatedBy->name)
    //         ->action('View Project', url('/projects/' . $this->project->id))
    //         ->line('Thank you for using our application!');

    //     return $message;
    // }
}
