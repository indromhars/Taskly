<?php

namespace App\Livewire;

use Livewire\Component;

class AutoRefresh extends Component
{
    public $refreshKey = 0;

    protected $listeners = [
        'projectCreated' => 'refresh',
        'projectUpdated' => 'refresh',
        'projectDeleted' => 'refresh',
        'taskCreated' => 'refresh',
        'taskUpdated' => 'refresh',
        'taskDeleted' => 'refresh',
        'commentCreated' => 'refresh',
        'commentUpdated' => 'refresh',
        'commentDeleted' => 'refresh',
        'teamInvitationSent' => 'refresh',
        'teamInvitationAccepted' => 'refresh',
        'teamInvitationRejected' => 'refresh',
    ];

    public function refresh()
    {
        $this->refreshKey++;
    }

    public function render()
    {
        return view('livewire.auto-refresh');
    }
}
