<?php

namespace App\Actions\Jetstream;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;
use Laravel\Jetstream\Events\TeamMemberRemoved;

class LeaveTeam
{
    /**
     * Remove the currently authenticated user from the given team.
     */
    public function leave(User $user, Team $team): void
    {
        $this->ensureUserDoesNotOwnTeam($user, $team);

        $team->removeUser($user);

        TeamMemberRemoved::dispatch($team, $user);
    }

    /**
     * Ensure that the currently authenticated user does not own the team.
     */
    protected function ensureUserDoesNotOwnTeam(User $user, Team $team): void
    {
        if ($user->id === $team->owner->id) {
            throw ValidationException::withMessages([
                'team' => [__('You may not leave a team that you created.')],
            ])->errorBag('leaveTeam');
        }
    }
}
