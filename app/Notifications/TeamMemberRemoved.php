<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Team;

class TeamMemberRemoved extends Notification implements ShouldQueue
{
    use Queueable;

    protected $team;
    protected $remover;

    public function __construct(Team $team, $remover)
    {
        $this->team = $team;
        $this->remover = $remover;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->remover->name . ' has removed you from the team "' . $this->team->name . '"',
            'team_id' => $this->team->id,
            'team_name' => $this->team->name,
            'remover_id' => $this->remover->id,
            'remover_name' => $this->remover->name,
            'type' => 'team_member_removed'
        ];
    }
}
