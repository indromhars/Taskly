<?php

namespace App\Notifications;

use App\Models\Team;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TeamMemberRemovedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $team;
    protected $removedBy;

    public function __construct(Team $team, User $removedBy)
    {
        $this->team = $team;
        $this->removedBy = $removedBy;
    }

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Team Member Removed')
            ->line('You have been removed from the team: "' . $this->team->name . '"')
            ->line('Removed by: ' . $this->removedBy->name)
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable): array
    {
        return [
            'team_id' => $this->team->id,
            'team_name' => $this->team->name,
            'removed_by_id' => $this->removedBy->id,
            'removed_by_name' => $this->removedBy->name,
        ];
    }
}
