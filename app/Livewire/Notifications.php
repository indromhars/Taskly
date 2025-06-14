<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Notifications extends Component
{
    use WithPagination;

    public function getUnreadCountProperty()
    {
        return Auth::user()->unreadNotifications()->count();
    }

    public function markAsRead($notificationId)
    {
        Auth::user()->notifications()->where('id', $notificationId)->update(['read_at' => now()]);
    }

    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
    }

    public function render()
    {
        return view('livewire.notifications', [
            'notifications' => Auth::user()->notifications()->paginate(10)
        ]);
    }
}
