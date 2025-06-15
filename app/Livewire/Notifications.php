<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Notifications extends Component
{
    use WithPagination;

    public $selectedNotifications = [];
    public $selectAll = false;

    protected $listeners = [
        'notificationReceived' => 'loadNotifications',
        'team.invitation.sent' => 'loadNotifications'
    ];

    public function mount()
    {
        // We don't need to explicitly call loadNotifications here anymore
        // The render method will handle initial loading
    }

    public function loadNotifications()
    {
        // This method will now only reset pagination and clear selections
        $this->resetPage(); // Ensures render() fetches data from the first page
        $this->selectedNotifications = [];
        $this->selectAll = false;
    }

    public function getUnreadCountProperty()
    {
        /** @var \App\Models\User $currentUser */
        $currentUser = Auth::user();
        return $currentUser->unreadNotifications()->count();
    }

    public function markAsRead($notificationId)
    {
        /** @var \App\Models\User $currentUser */
        $currentUser = Auth::user();
        $currentUser->notifications()->where('id', $notificationId)->update(['read_at' => now()]);
        $this->loadNotifications(); // Refresh notifications after marking as read
    }

    public function markAllAsRead()
    {
        /** @var \App\Models\User $currentUser */
        $currentUser = Auth::user();
        $currentUser->unreadNotifications->markAsRead();
        $this->loadNotifications(); // Refresh notifications after marking all as read
    }

    public function deleteSelected()
    {
        if (!empty($this->selectedNotifications)) {
            /** @var \App\Models\User $currentUser */
            $currentUser = Auth::user();
            $currentUser->notifications()->whereIn('id', $this->selectedNotifications)->delete();
            $this->loadNotifications(); // Refresh notifications after deletion
        }
    }

    public function deleteAll()
    {
        /** @var \App\Models\User $currentUser */
        $currentUser = Auth::user();
        $currentUser->notifications()->delete();
        $this->loadNotifications(); // Refresh notifications after deletion
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            /** @var \App\Models\User $currentUser */
            $currentUser = Auth::user();
            $this->selectedNotifications = $currentUser->notifications()->pluck('id')->toArray();
        } else {
            $this->selectedNotifications = [];
        }
    }

    public function render()
    {
        /** @var \App\Models\User $currentUser */
        $currentUser = Auth::user();
        return view('livewire.notifications', [
            'notifications' => $currentUser->notifications()->paginate(10) // Fetch here
        ]);
    }
}
