<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Notifications</h2>
        <div class="flex space-x-2">
            @if($this->unreadCount > 0)
                <button wire:click="markAllAsRead" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Mark all as read
                </button>
            @endif
            @if(count($selectedNotifications) > 0)
                <button wire:click="deleteSelected" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                    Delete Selected
                </button>
            @endif
            <button wire:click="deleteAll" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                Clear All
            </button>
        </div>
    </div>

    <div class="mb-4">
        <label class="inline-flex items-center">
            <input type="checkbox" wire:model.live="selectAll" class="form-checkbox h-5 w-5 text-blue-600">
            <span class="ml-2 text-gray-700">Select All</span>
        </label>
    </div>

    <div class="space-y-4">
        @forelse($notifications as $notification)
            <div class="bg-white rounded-lg shadow p-4 {{ is_null($notification->read_at) ? 'border-l-4 border-blue-500' : '' }}">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <div class="flex items-center space-x-2">
                            <input type="checkbox"
                                   wire:model.live="selectedNotifications"
                                   value="{{ $notification->id }}"
                                   class="form-checkbox h-5 w-5 text-blue-600">
                            @php
                                // Ensure notification data is treated as an array
                                $notificationData = is_string($notification->data) ? json_decode($notification->data, true) : $notification->data;
                                // Ensure notificationData is an array and provide default values for 'responded' and 'response'
                                if (!is_array($notificationData)) {
                                    $notificationData = [];
                                }
                                if (($notificationData['type'] ?? '') === 'team_invitation' && !isset($notificationData['responded'])) {
                                    $notificationData['responded'] = false;
                                }
                                if (($notificationData['type'] ?? '') === 'team_invitation' && !isset($notificationData['response'])) {
                                    $notificationData['response'] = null;
                                }
                            @endphp
                            @switch($notificationData['type'] ?? '')
                                @case('task_added')
                                    <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    @break
                                @case('task_edited')
                                    <svg class="h-5 w-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    @break
                                @case('task_deleted')
                                    <svg class="h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    @break
                                @case('task_commented')
                                    <svg class="h-5 w-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                    </svg>
                                    @break
                                @case('task_status_changed')
                                    <svg class="h-5 w-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                    </svg>
                                    @break
                                @case('team_invitation')
                                    <svg class="h-5 w-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                    </svg>
                                    @break
                                @case('team_invitation_response')
                                    <svg class="h-5 w-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                    </svg>
                                    @break
                                @case('team_member_removed')
                                    <svg class="h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                    </svg>
                                    @break
                                @default
                                    <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                            @endswitch
                            <div>
                                @php
                                    $message = '';
                                    $type = $notificationData['type'] ?? '';

                                    switch($type) {
                                        case 'task_added':
                                            $message = "New task '" . ($notificationData['task_title'] ?? 'N/A') . "' has been added";
                                            break;
                                        case 'task_edited':
                                            $message = "Task '" . ($notificationData['task_title'] ?? 'N/A') . "' has been edited";
                                            break;
                                        case 'task_deleted':
                                            $message = "Task '" . ($notificationData['task_title'] ?? 'N/A') . "' has been deleted";
                                            break;
                                        case 'task_commented':
                                            $message = "New comment on task '" . ($notificationData['task_title'] ?? 'N/A') . "'";
                                            break;
                                        case 'task_status_changed':
                                            $movedBy = $notificationData['moved_by_name'] ?? 'Someone';
                                            $taskTitle = $notificationData['task_title'] ?? 'a task';
                                            $oldStatus = $notificationData['old_status'] ?? 'previous status';
                                            $newStatus = $notificationData['new_status'] ?? 'new status';
                                            $message = "{$movedBy} moved task '{$taskTitle}' from '{$oldStatus}' to '{$newStatus}'";
                                            break;
                                        case 'team_invitation':
                                            $inviterName = $notificationData['inviter_name'] ?? 'Someone';
                                            $teamName = $notificationData['team_name'] ?? 'a team';
                                            $role = $notificationData['role'] ?? 'member';
                                            $message = "{$inviterName} has invited you to join their team '{$teamName}' as {$role}";
                                            break;
                                        case 'team_invitation_response':
                                            $message = $notificationData['message'];
                                            break;
                                        case 'team_member_removed':
                                            $removerName = $notificationData['remover_name'] ?? 'Someone';
                                            $teamName = $notificationData['team_name'] ?? 'a team';
                                            $message = "{$removerName} has removed you from the team '{$teamName}'";
                                            break;
                                        default:
                                            $message = $notificationData['message'] ?? 'Notification';
                                    }
                                @endphp
                                <p class="text-gray-800">{{ $message }}</p>
                                @if($type === 'task_status_changed')
                                    <div class="mt-1 text-sm text-gray-600">
                                        <span class="font-medium">From:</span> {{ $notificationData['old_status'] ?? 'N/A' }}
                                        <span class="mx-2">→</span>
                                        <span class="font-medium">To:</span> {{ $notificationData['new_status'] ?? 'N/A' }}
                                    </div>
                                @endif
                                @if($type === 'team_invitation')
                                    @if(($notificationData['responded'] ?? false) === true)
                                        <div class="mt-1 text-sm {{ ($notificationData['response'] ?? '') === 'accepted' ? 'text-green-600' : 'text-red-600' }}">
                                            You {{ $notificationData['response'] ?? 'responded to' }} this invitation
                                        </div>
                                    @elseif(isset($notificationData['actions']) && ($notificationData['responded'] ?? false) === false)
                                        <div class="mt-3 flex space-x-2">
                                            @foreach($notificationData['actions'] as $action)
                                                <a href="{{ $action['url'] }}"
                                                   class="px-4 py-2 rounded-md text-sm font-medium {{ $action['class'] }}">
                                                    {{ $action['label'] }}
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                @endif
                                @if($type === 'team_invitation_response')
                                    <div class="mt-1 text-sm {{ $notificationData['response'] === 'accepted' ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $notificationData['message'] }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                    </div>
                    @if(is_null($notification->read_at))
                        <button wire:click="markAsRead('{{ $notification->id }}')" class="text-blue-600 hover:text-blue-800">
                            Mark as read
                        </button>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center py-8">
                <p class="text-gray-500">No notifications found</p>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $notifications->links() }}
    </div>
</div>
