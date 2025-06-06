<div>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Tasks -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Tasks</dt>
                                    <dd class="text-2xl font-semibold text-gray-900">{{ $totalTasks }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Completed Tasks -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Completed (30 days)</dt>
                                    <dd class="text-2xl font-semibold text-gray-900">{{ $completedTasks }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Overdue Tasks -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-red-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Overdue Tasks</dt>
                                    <dd class="text-2xl font-semibold text-gray-900">{{ $overdueTasks }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Tasks -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Upcoming (7 days)</dt>
                                    <dd class="text-2xl font-semibold text-gray-900">{{ $upcomingTasks }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Tasks by Priority -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Tasks by Priority</h3>
                        <div class="space-y-4">
                            @foreach(['high' => 'High', 'medium' => 'Medium', 'low' => 'Low'] as $priority => $label)
                                <div>
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="text-sm font-medium text-gray-700">{{ $label }}</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $tasksByPriority[$priority] ?? 0 }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-{{ $priority === 'high' ? 'red' : ($priority === 'medium' ? 'yellow' : 'green') }}-500 h-2 rounded-full" style="width: {{ isset($tasksByPriority[$priority]) ? ($tasksByPriority[$priority] / $totalTasks * 100) : 0 }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Tasks by Status -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Tasks by Status</h3>
                        <div class="space-y-4">
                            @foreach(['todo' => 'To Do', 'in_progress' => 'In Progress', 'done' => 'Done'] as $status => $label)
                                <div>
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="text-sm font-medium text-gray-700">{{ $label }}</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $tasksByStatus[$status] ?? 0 }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="@if($status === 'todo') bg-gray-500 @elseif($status === 'in_progress') bg-blue-500 @else bg-green-500 @endif h-2 rounded-full" style="width: {{ isset($tasksByStatus[$status]) ? ($tasksByStatus[$status] / max($totalTasks, 1) * 100) : 0 }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
                <!-- Recent Tasks -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Tasks</h3>
                        <div class="space-y-4">
                            @forelse($recentTasks as $task)
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-900">{{ $task->title }}</h4>
                                        <p class="text-sm text-gray-500">{{ $task->project->title }}</p>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full
                                            @if($task->priority === 'high') bg-red-100 text-red-700
                                            @elseif($task->priority === 'medium') bg-yellow-100 text-yellow-700
                                            @else bg-green-100 text-green-700
                                            @endif">
                                            {{ ucfirst($task->priority) }}
                                        </span>
                                        <span class="px-2 py-1 text-xs font-medium rounded-full
                                            @if($task->status === 'todo') bg-gray-100 text-gray-700
                                            @elseif($task->status === 'in_progress') bg-blue-100 text-blue-700
                                            @else bg-green-100 text-green-700
                                            @endif">
                                            {{ $task->status === 'in_progress' ? 'In Progress' : ucfirst($task->status) }}
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500">No recent tasks</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Team Tasks Overview -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Team Tasks Overview</h3>
                        <div class="space-y-4">
                            @forelse($teamTasks as $project)
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-900">{{ $project->title }}</h4>
                                        <p class="text-sm text-gray-500">{{ $project->tasks_count }} active tasks</p>
                                    </div>
                                    <a href="{{ route('projects.kanban', ['project' => $project->id]) }}" class="text-sm text-indigo-600 hover:text-indigo-500">
                                        View Board
                                    </a>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500">No active projects</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
