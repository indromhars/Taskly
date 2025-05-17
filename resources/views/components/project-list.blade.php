<div class="bg-white rounded-lg shadow-md p-4">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold">Your Projects</h3>
        <a href="{{ route('projects.create') }}" class="inline-flex items-center px-3 py-2 bg-indigo-600 text-white text-sm rounded-md hover:bg-indigo-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            New Project
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($projects as $project)
            <div class="border border-gray-200 rounded-md p-4 hover:shadow-md transition-shadow">
                <div class="flex justify-between items-start">
                    <h4 class="font-medium text-gray-800">{{ $project->name }}</h4>
                    <span class="px-2 py-1 text-xs rounded-full {{ $project->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ ucfirst($project->status) }}
                    </span>
                </div>
                <p class="text-sm text-gray-600 mt-2 line-clamp-2">{{ $project->description }}</p>
                <div class="mt-4 flex justify-between items-center">
                    <div class="flex -space-x-2">
                        @foreach($project->users->take(3) as $user)
                            <img class="h-6 w-6 rounded-full border border-white" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
                        @endforeach
                        @if($project->users->count() > 3)
                            <div class="h-6 w-6 rounded-full bg-gray-200 border border-white flex items-center justify-center text-xs text-gray-600">+{{ $project->users->count() - 3 }}</div>
                        @endif
                    </div>
                    <a href="{{ route('projects.show', $project) }}" class="text-sm text-indigo-600 hover:text-indigo-800">View</a>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-8">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                </svg>
                <h4 class="mt-2 text-gray-700 font-medium">No projects found</h4>
                <p class="text-gray-500 mt-1">Get started by creating a new project</p>
                <a href="{{ route('projects.create') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Create Project
                </a>
            </div>
        @endforelse
    </div>
</div>
