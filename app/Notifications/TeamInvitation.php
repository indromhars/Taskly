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
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        // Ensure 'responded' and 'response' keys are always present
        $responded = (isset($this->invitation->responded_at) && $this->invitation->responded_at);
        $responseStatus = $this->invitation->response;

        $notificationData = [
            'message' => $this->inviter->name . ' has invited you to join their team "' . $this->team->name . '"',
            'team_id' => $this->team->id,
            'team_name' => $this->team->name,
            'inviter_id' => $this->inviter->id,
            'inviter_name' => $this->inviter->name,
            'invitation_id' => $this->invitation->id,
            'role' => $this->invitation->role,
            'type' => 'team_invitation',
            'responded' => $responded,
            'response' => $responseStatus,
        ];

        // Only add actions if the invitation has NOT been responded to
        if (!$responded) {
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

            $notificationData['actions'] = [
                [
                    'label' => 'Accept',
                    'url' => $acceptUrl,
                    'class' => 'bg-green-500 hover:bg-green-600 text-white'
                ],
                [
                    'label' => 'Reject',
                    'url' => $rejectUrl,
                    'class' => 'bg-red-500 hover:bg-red-600 text-white'
                ]
            ];
        }

        return $notificationData;
    }
}
