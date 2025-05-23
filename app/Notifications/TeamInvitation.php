<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Team;
use Illuminate\Support\Facades\URL;

class TeamInvitation extends Notification implements ShouldQueue
{
    use Queueable;

    protected $team;
    protected $inviter;
    protected $invitation;

    public function __construct(Team $team, $inviter, $invitation)
    {
        $this->team = $team;
        $this->inviter = $inviter;
        $this->invitation = $invitation;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $acceptUrl = URL::temporarySignedRoute(
            'team.invitation.accept',
            now()->addDays(7),
            ['invitation' => $this->invitation->id]
        );

        $rejectUrl = URL::temporarySignedRoute(
            'team.invitation.reject',
            now()->addDays(7),
            ['invitation' => $this->invitation->id]
        );

        return (new MailMessage)
            ->subject('Team Invitation: ' . $this->team->name)
            ->greeting('Hello!')
            ->line($this->inviter->name . ' has invited you to join their team "' . $this->team->name . '"')
            ->line('Role: ' . ucfirst($this->invitation->role))
            ->action('Accept Invitation', $acceptUrl)
            ->line('Or click the button below to reject:')
            ->action('Reject Invitation', $rejectUrl)
            ->line('This invitation will expire in 7 days.')
            ->line('If you did not expect this invitation, you can safely ignore this email.')
            ->line('Thank you for using our application!');
    }
}
