<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class NotificationCount extends Component
{
    protected $listeners = [
        'notificationReceived' => '$refresh',
        'team.invitation.sent' => '$refresh'
    ];

    public function getUnreadCountProperty()
    {
        return Auth::user()->unreadNotifications()->count();
    }

    public function render()
    {
        return view('livewire.notification-count');
    }
}
