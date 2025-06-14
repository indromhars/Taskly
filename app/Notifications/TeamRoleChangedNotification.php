<?php

namespace App\Notifications;

use App\Models\Team;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TeamRoleChangedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $team;
    protected $changedBy;
    protected $oldRole;
    protected $newRole;

    public function __construct(Team $team, User $changedBy, string $oldRole, string $newRole)
    {
        $this->team = $team;
        $this->changedBy = $changedBy;
        $this->oldRole = $oldRole;
        $this->newRole = $newRole;
    }

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Team Role Changed')
            ->line('Your role in team "' . $this->team->name . '" has been changed.')
            ->line('From: ' . $this->oldRole)
            ->line('To: ' . $this->newRole)
            ->line('Changed by: ' . $this->changedBy->name)
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable): array
    {
        return [
            'team_id' => $this->team->id,
            'team_name' => $this->team->name,
            'changed_by_id' => $this->changedBy->id,
            'changed_by_name' => $this->changedBy->name,
            'old_role' => $this->oldRole,
            'new_role' => $this->newRole,
        ];
    }
}
