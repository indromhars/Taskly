<?php

namespace App\Actions\Fortify;

use App\Models\Team;
use App\Notifications\TeamInvitation;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Rules\Password;
use Laravel\Jetstream\Jetstream;

class InviteTeamMember
{
    public function invite($user, Team $team, string $email, string $role = null)
    {
        Gate::forUser($user)->authorize('addTeamMember', $team);

        $this->validate($team, $email, $role);

        $invitation = $team->teamInvitations()->create([
            'email' => $email,
            'role' => $role,
        ]);

        // Send notification
        $invitation->notify(new TeamInvitation($team, $user));

        return $invitation;
    }

    protected function validate($team, string $email, ?string $role): void
    {
        Validator::make([
            'email' => $email,
            'role' => $role,
        ], $this->rules(), [
            'email.unique' => __('This user has already been invited to the team.'),
        ])->validate();
    }

    protected function rules(): array
    {
        return array_filter([
            'email' => ['required', 'email', 'max:255', 'unique:team_invitations,email'],
            'role' => Jetstream::hasRoles()
                            ? ['required', 'string', 'in:'.implode(',', array_keys(Jetstream::roles()))]
                            : '',
        ]);
    }
}
