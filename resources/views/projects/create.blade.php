<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Create New Project') }}
                </h2>
                <p class="text-gray-600 mt-1">Start a new project and invite your team</p>
            </div>
            <a href="{{ route('projects.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                </svg>
                Back to Projects
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="#" method="POST" class="p-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <x-label for="name" value="{{ __('Project Name') }}" />
                                <x-input id="name" type="text" name="name" class="mt-1 block w-full" required autofocus />
                                <p class="text-sm text-gray-500 mt-1">Choose a clear and descriptive name for your project.</p>
                            </div>

                            <div>
                                <x-label for="description" value="{{ __('Description') }}" />
                                <textarea id="description" name="description" rows="4" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                            </div>

                            <div>
                                <x-label for="due_date" value="{{ __('Due Date') }}" />
                                <x-input id="due_date" type="date" name="due_date" class="mt-1 block w-full" />
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <x-label for="status" value="{{ __('Status') }}" />
                                <select id="status" name="status" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="active">Active</option>
                                    <option value="planning">Planning</option>
                                    <option value="on_hold">On Hold</option>
                                    <option value="completed">Completed</option>
                                </select>
                            </div>

                            <div>
                                <x-label for="team_members" value="{{ __('Team Members') }}" />
                                <div class="mt-1 p-3 border border-gray-300 rounded-md">
                                    <div class="flex flex-wrap gap-2">
                                        <div class="flex items-center p-2 bg-gray-100 rounded-md">
                                            <span class="h-6 w-6 rounded-full bg-indigo-500 text-white flex items-center justify-center text-xs mr-2">JD</span>
                                            <span class="text-sm">John Doe</span>
                                            <button type="button" class="ml-2 text-gray-400 hover:text-gray-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                        <button type="button" class="p-2 border border-dashed border-gray-300 rounded-md text-gray-500 hover:text-gray-700 hover:border-gray-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <x-label for="tags" value="{{ __('Tags') }}" />
                                <div class="mt-1 flex flex-wrap gap-2">
                                    <span class="px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full text-sm">Design</span>
                                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">Development</span>
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">Marketing</span>
                                    <button type="button" class="px-2 py-1 border border-dashed border-gray-300 rounded-full text-gray-500 hover:text-gray-700 hover:border-gray-400 text-sm">
                                        + Add Tag
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end mt-6 border-t border-gray-200 pt-6">
                        <x-button class="ml-3 bg-indigo-600 hover:bg-indigo-700">
                            {{ __('Create Project') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
