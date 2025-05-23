<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Actions\Jetstream\LeaveTeam;

class TeamController extends Controller
{
    public function switchTeam(Request $request)
    {
        $user = Auth::user();
        $team = Team::findOrFail($request->team_id);

        Log::info('Team switch attempt', [
            'user_id' => $user->id,
            'team_id' => $team->id,
            'current_team' => $user->currentTeam->id,
            'user_teams' => $user->teams->pluck('id')->toArray(),
            'all_teams' => $user->allTeams()->pluck('id')->toArray()
        ]);

        // Check if user has access to the team (either as member or through other permissions)
        if ($user->allTeams()->contains($team)) {
            $user->switchTeam($team);
            Log::info('Team switched successfully', [
                'new_team_id' => $team->id
            ]);
            return redirect()->route('teams.show', $team);
        } else {
            Log::warning('Team switch failed - user not in team', [
                'user_id' => $user->id,
                'team_id' => $team->id,
                'user_teams' => $user->teams->pluck('id')->toArray(),
                'all_teams' => $user->allTeams()->pluck('id')->toArray()
            ]);
            return redirect()->back();
        }
    }

    public function leave(Team $team, LeaveTeam $leaveTeam)
    {
        $user = auth()->user();
        $leaveTeam->leave($user, $team);
        // Switch to personal team if available
        $personalTeam = $user->ownedTeams()->where('personal_team', true)->first();
        if ($personalTeam) {
            $user->switchTeam($personalTeam);
        }
        return redirect()->route('dashboard')->with('success', __('You have left the team.'));
    }
}
