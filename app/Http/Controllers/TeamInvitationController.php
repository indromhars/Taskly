<?php

namespace App\Http\Controllers;

use App\Models\TeamInvitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TeamInvitationResponse;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class TeamInvitationController extends Controller
{
    public function accept(Request $request, TeamInvitation $invitation)
    {
        if (! $request->hasValidSignature()) {
            abort(401);
        }

        /** @var \App\Models\User $currentUser */
        $currentUser = Auth::user();

        if ($invitation->email !== $currentUser->email) {
            abort(403);
        }

        $team = $invitation->team;

        // Add user to team
        $currentUser->teams()->syncWithoutDetaching([$team->id => ['role' => $invitation->role]]);

        // Find and update the specific notification for this invitation
        $notification = $currentUser->notifications()
            ->where('data->invitation_id', $invitation->id)
            ->where('type', 'team_invitation')
            ->first();

        if ($notification) {
            $notificationData = $notification->data; // Get current data
            $notificationData['responded'] = true; // Update responded status
            $notificationData['response'] = 'accepted'; // Set response type

            // Force update the 'data' attribute in the database
            $notification->forceFill(['data' => $notificationData, 'read_at' => now()])->save();
        }

        // Notify team owner
        $team->owner->notify(new TeamInvitationResponse(
            $team,
            $currentUser,
            'accepted'
        ));

        // Delete the invitation (it has served its purpose, and notification is updated)
        $invitation->delete();

        return redirect()->route('teams.show', $team)
            ->with('success', 'You have joined the team successfully!')
            ->with('dispatchBrowserEvent', 'notificationReceived');
    }

    public function reject(Request $request, TeamInvitation $invitation)
    {
        if (! $request->hasValidSignature()) {
            abort(401);
        }

        /** @var \App\Models\User $currentUser */
        $currentUser = Auth::user();

        if ($invitation->email !== $currentUser->email) {
            abort(403);
        }

        $team = $invitation->team;

        // Find and update the specific notification for this invitation
        $notification = $currentUser->notifications()
            ->where('data->invitation_id', $invitation->id)
            ->where('type', 'team_invitation')
            ->first();

        if ($notification) {
            $notificationData = $notification->data; // Get current data
            $notificationData['responded'] = true; // Update responded status
            $notificationData['response'] = 'rejected'; // Set response type

            // Force update the 'data' attribute in the database
            $notification->forceFill(['data' => $notificationData, 'read_at' => now()])->save();
        }

        // Notify team owner
        $team->owner->notify(new TeamInvitationResponse(
            $team,
            $currentUser,
            'rejected'
        ));

        // Delete the invitation
        $invitation->delete();

        return redirect()->route('dashboard')
            ->with('info', 'You have declined the team invitation.')
            ->with('dispatchBrowserEvent', 'notificationReceived');
    }
}
