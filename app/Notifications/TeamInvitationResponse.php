<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Team;

class TeamInvitationResponse extends Notification implements ShouldQueue
{
    use Queueable;

    protected $team;
    protected $user;
    protected $response;

    public function __construct(Team $team, $user, $response)
    {
        $this->team = $team;
        $this->user = $user;
        $this->response = $response;
    }

    public function via($notifiable)
    {
        // Only send to the team owner
        return $notifiable->id === $this->team->user_id ? ['database'] : [];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->response === 'accepted'
                ? $this->user->name . ' has accepted your invitation to join the team "' . $this->team->name . '"'
                : $this->user->name . ' has declined your invitation to join the team "' . $this->team->name . '"',
            'team_id' => $this->team->id,
            'team_name' => $this->team->name,
            'user_id' => $this->user->id,
            'user_name' => $this->user->name,
            'response' => $this->response,
            'type' => 'team_invitation_response'
        ];
    }
}
