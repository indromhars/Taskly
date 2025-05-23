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
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $message = (new MailMessage)
            ->subject('Team Invitation Response: ' . $this->team->name)
            ->greeting('Hello!');

        if ($this->response === 'accepted') {
            $message->line($this->user->name . ' has accepted your invitation to join the team "' . $this->team->name . '"')
                ->action('View Team', url('/teams/' . $this->team->id));
        } else {
            $message->line($this->user->name . ' has declined your invitation to join the team "' . $this->team->name . '"');
        }

        return $message;
    }
}
