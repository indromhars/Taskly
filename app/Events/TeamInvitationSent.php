<?php

namespace App\Events;

use App\Models\Team;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TeamInvitationSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $invitedUser;
    public $team;
    public $inviter;

    public function __construct(User $invitedUser, Team $team, User $inviter)
    {
        $this->invitedUser = $invitedUser;
        $this->team = $team;
        $this->inviter = $inviter;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('user.' . $this->invitedUser->id);
    }

    public function broadcastAs()
    {
        return 'team.invitation.sent';
    }

    public function broadcastWith()
    {
        return [
            'team_id' => $this->team->id,
            'team_name' => $this->team->name,
            'inviter_name' => $this->inviter->name,
        ];
    }
}
