<div class="p-4">
    <div class="mb-6 flex items-center justify-between">
<div>
            <h2 class="text-2xl font-bold text-gray-900">{{ $project->title }} - Kanban Board</h2>
            <p class="mt-1 text-sm text-gray-500">Manage your project tasks with drag and drop</p>
        </div>
        <button
            wire:click="$dispatch('openModal', { component: 'task.create-task', arguments: { project: {{ $project->id }} }})"
            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
        >
            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Add Task
        </button>
    </div>

    <div wire:sortable-group="updateTaskOrder" class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($statuses as $statusId => $statusTitle)
            <div wire:key="status-{{ $statusId }}" class="bg-gray-50 rounded-lg shadow-sm border border-gray-200">
                <div class="p-4 border-b border-gray-200 bg-white rounded-t-lg">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-700">{{ $statusTitle }}</h3>
                        <span class="px-2.5 py-1 text-sm font-medium text-gray-600 bg-gray-100 rounded-full">
                            {{ isset($this->groupedTasks[$statusId]) ? count($this->groupedTasks[$statusId]) : 0 }}
                        </span>
                    </div>
                </div>

                <div
                    wire:sortable-group.item-group="{{ $statusId }}"
                    wire:sortable-group.options="{ animation: 150 }"
                    class="p-4 space-y-3 min-h-[calc(100vh-300px)] overflow-y-auto"
                >
                    @if(empty($this->groupedTasks[$statusId]))
                        <div class="flex flex-col items-center justify-center h-32 text-center">
                            <svg class="h-12 w-12 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <p class="text-sm text-gray-500">No tasks yet</p>
                            <button
                                wire:click="$dispatch('openModal', { component: 'task.create-task', arguments: { project: {{ $project->id }} }})"
                                class="mt-2 text-sm text-indigo-600 hover:text-indigo-500"
                            >
                                Create a task
                            </button>
                        </div>
                    @else
                        @foreach($this->groupedTasks[$statusId] as $task)
                            <div
                                wire:key="task-{{ $task->id }}"
                                wire:sortable-group.item="{{ $task->id }}"
                                wire:sortable-group.options="{ animation: 150 }"
                                class="bg-white rounded-lg shadow p-4 cursor-move hover:shadow-md transition-shadow border border-gray-100"
                            >
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between">
                                            <h4 class="font-medium text-gray-900 text-base">{{ $task->title }}</h4>
                                            <div class="flex items-center space-x-2">
                                                <button
                                                    wire:click="$dispatch('openModal', { component: 'task.edit-task', arguments: { task: {{ $task->id }} }})"
                                                    class="text-gray-400 hover:text-gray-500 p-1 rounded-full hover:bg-gray-100"
                                                >
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </button>
                                                <button
                                                    wire:click="$dispatch('openModal', { component: 'task.delete-task', arguments: { task: {{ $task->id }} }})"
                                                    class="text-gray-400 hover:text-red-500 p-1 rounded-full hover:bg-gray-100"
                                                >
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                                <!-- Comment Button -->
                                                <button
                                                    wire:click="$dispatch('openModal', { component: 'comment.task-comment', arguments: { task: {{ $task->id }} }})"
                                                    class="text-gray-400 hover:text-blue-500 p-1 rounded-full hover:bg-gray-100"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                        <p class="text-sm text-gray-500 mt-2 line-clamp-2">{{ $task->description }}</p>
                                    </div>
                                </div>
                                <div class="mt-4 flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        @if($task->priority === 'high')
                                            <span class="px-2 py-1 text-xs font-medium text-red-700 bg-red-100 rounded-full">High</span>
                                        @elseif($task->priority === 'medium')
                                            <span class="px-2 py-1 text-xs font-medium text-yellow-700 bg-yellow-100 rounded-full">Medium</span>
                                        @else
                                            <span class="px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full">Low</span>
                                        @endif
                                    </div>
                                    <div class="flex items-center space-x-4 text-sm text-gray-500">
                                        <div class="flex items-center">
                                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $task->due_date?->format('M d, Y') }}
                                        </div>
                                        <div class="flex items-center">
                                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            {{ $task->user?->name ?? 'Unassigned' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('taskUpdated', () => {
            // You can add any custom JavaScript here if needed
        });
    });
</script>
@endpush
