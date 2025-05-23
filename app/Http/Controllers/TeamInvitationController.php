<?php

namespace App\Http\Controllers;

use App\Models\TeamInvitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TeamInvitationResponse;

class TeamInvitationController extends Controller
{
    public function accept(Request $request, TeamInvitation $invitation)
    {
        if (!$request->hasValidSignature()) {
            abort(401);
        }

        if ($invitation->email !== Auth::user()->email) {
            abort(403);
        }

        $team = $invitation->team;

        // Add user to team
        Auth::user()->teams()->attach($team, ['role' => $invitation->role]);

        // Notify team owner
        $team->owner->notify(new TeamInvitationResponse(
            $team,
            Auth::user(),
            'accepted'
        ));

        // Delete the invitation
        $invitation->delete();

        return redirect()->route('teams.show', $team)
            ->with('success', 'You have joined the team successfully!');
    }

    public function reject(Request $request, TeamInvitation $invitation)
    {
        if (!$request->hasValidSignature()) {
            abort(401);
        }

        if ($invitation->email !== Auth::user()->email) {
            abort(403);
        }

        $team = $invitation->team;

        // Notify team owner
        $team->owner->notify(new TeamInvitationResponse(
            $team,
            Auth::user(),
            'rejected'
        ));

        // Delete the invitation
        $invitation->delete();

        return redirect()->route('dashboard')
            ->with('info', 'You have declined the team invitation.');
    }
}
