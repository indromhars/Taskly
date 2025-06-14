<?php

use Illuminate\Support\Facades\Route;
use App\Models\Team;
use App\Http\Controllers\TeamInvitationController;
use App\Http\Controllers\TeamController;
use App\Livewire\Project\ProjectList;
use App\Livewire\Task\TaskKanbanBoard;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Projects Routes
    Route::get('/projects', ProjectList::class)->name('projects.index');

    Route::get('/projects/create', function () {
        return view('projects.create');
    })->name('projects.create');

    // Team routes
    Route::get('/teams/create', function () {
        return view('teams.create');
    })->name('teams.create');

    Route::get('/teams/{team}', function (Team $team) {
        return view('teams.show', ['team' => $team]);
    })->name('teams.show');

    Route::put('/current-team', [TeamController::class, 'switchTeam'])->name('current-team.update');

    // Team invitation routes
    Route::get('/teams/invitations/{invitation}/accept', [TeamInvitationController::class, 'accept'])
        ->name('team.invitation.accept')
        ->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);

    Route::get('/teams/invitations/{invitation}/reject', [TeamInvitationController::class, 'reject'])
        ->name('team.invitation.reject')
        ->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);

    Route::delete('/teams/{team}/leave', [TeamController::class, 'leave'])->name('teams.leave');

    // Kanban Board Routes
    Route::get('/projects/{project}/kanban', TaskKanbanBoard::class)
        ->name('projects.kanban')
        ->where('project', '[0-9]+');

    Route::get('/notifications', function () {
        return view('notifications.index');
    })->name('notifications.index');
});
