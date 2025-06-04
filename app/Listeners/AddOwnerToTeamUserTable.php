<?php

namespace App\Listeners;

use Laravel\Jetstream\Events\TeamCreated;

class AddOwnerToTeamUserTable
{
    public function handle(TeamCreated $event)
    {
        $team = $event->team;
        if ($team->owner_id) {
            $team->users()->syncWithoutDetaching([$team->owner_id => ['role' => 'admin']]);
        }
    }
}
