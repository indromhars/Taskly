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
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $message = (new MailMessage)
            ->subject('Project Update: ' . $this->project->title)
            ->greeting('Hello!');

        switch ($this->updateType) {
            case 'created':
                $message->line($this->updater->name . ' has created a new project "' . $this->project->title . '"')
                    ->line('Description: ' . $this->project->description)
                    ->line('Start Date: ' . $this->project->start_date)
                    ->line('End Date: ' . $this->project->end_date);
                break;
            case 'updated':
                $message->line($this->updater->name . ' has updated the project "' . $this->project->title . '"');
                break;
            case 'deleted':
                $message->line($this->updater->name . ' has deleted the project "' . $this->project->title . '"');
                break;
        }

        return $message
            ->action('View Project', url('/projects/' . $this->project->id))
            ->line('Thank you for using our application!');
    }
}
