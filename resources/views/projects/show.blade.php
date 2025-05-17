<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Website Redesign
                </h2>
                <p class="text-gray-600 mt-1">Project details and task management</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('projects.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                    </svg>
                    Back to Projects
                </a>
                <button class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Add Task
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Project Overview -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="flex items-center">
                                <h3 class="text-lg font-semibold text-gray-800">Website Redesign</h3>
                                <span class="ml-3 px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Active</span>
                            </div>
                            <p class="text-gray-600 mt-2">Redesigning the company website with new branding and improved user experience.</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-500">Created on: <span class="font-medium">April 15, 2023</span></p>
                            <p class="text-sm text-gray-500">Due date: <span class="font-medium">June 30, 2023</span></p>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="bg-gray-50 p-4 rounded-md">
                            <h4 class="text-sm font-medium text-gray-500 uppercase">Tasks</h4>
                            <div class="mt-2 flex items-center">
                                <span class="text-2xl font-bold text-gray-800">24</span>
                                <div class="ml-3 flex items-center">
                                    <div class="h-2 w-24 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="h-full bg-indigo-600 rounded-full" style="width: 65%"></div>
                                    </div>
                                    <span class="ml-2 text-sm text-gray-600">65%</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-md">
                            <h4 class="text-sm font-medium text-gray-500 uppercase">Team Members</h4>
                            <div class="mt-2 flex items-center">
                                <div class="flex -space-x-2">
                                    <div class="h-8 w-8 rounded-full bg-indigo-500 border-2 border-white flex items-center justify-center text-xs text-white">JD</div>
                                    <div class="h-8 w-8 rounded-full bg-green-500 border-2 border-white flex items-center justify-center text-xs text-white">AK</div>
                                    <div class="h-8 w-8 rounded-full bg-yellow-500 border-2 border-white flex items-center justify-center text-xs text-white">MT</div>
                                </div>
                                <button class="ml-2 h-8 w-8 rounded-full bg-gray-200 border-2 border-white flex items-center justify-center text-xs text-gray-600 hover:bg-gray-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-md">
                            <h4 class="text-sm font-medium text-gray-500 uppercase">Recent Activity</h4>
                            <div class="mt-2">
                                <p class="text-sm text-gray-600">Last updated: <span class="font-medium">2 hours ago</span></p>
                                <p class="text-sm text-gray-600">By: <span class="font-medium">John Doe</span></p>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-md">
                            <h4 class="text-sm font-medium text-gray-500 uppercase">Tags</h4>
                            <div class="mt-2 flex flex-wrap gap-2">
                                <span class="px-2 py-1 bg-indigo-100 text-indigo-800 rounded-full text-xs">Design</span>
                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Development</span>
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Marketing</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kanban Board -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-4">Task Board</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- To Do Column -->
                    <div>
                        <div class="bg-gray-100 p-3 rounded-t-md">
                            <div class="flex justify-between items-center">
                                <h4 class="font-medium">To Do</h4>
                                <span class="px-2 py-1 bg-gray-200 rounded-full text-xs text-gray-700">4</span>
                            </div>
                        </div>
                        <div class="bg-gray-50 p-2 rounded-b-md min-h-[400px]">
                            <!-- Task Card -->
                            <div class="bg-white p-3 rounded-md shadow-sm mb-2">
                                <div class="flex justify-between items-start">
                                    <h5 class="font-medium text-gray-800">Design Homepage</h5>
                                    <span class="px-2 py-1 bg-indigo-100 text-indigo-800 rounded-full text-xs">Design</span>
                                </div>
                                <p class="text-sm text-gray-600 mt-2">Create wireframes and mockups for the new homepage design.</p>
                                <div class="mt-3 flex justify-between items-center">
                                    <div class="flex items-center">
                                        <div class="h-6 w-6 rounded-full bg-green-500 flex items-center justify-center text-xs text-white">AK</div>
                                    </div>
                                    <span class="text-xs text-gray-500">Due: Jun 10</span>
                                </div>
                            </div>

                            <!-- Task Card -->
                            <div class="bg-white p-3 rounded-md shadow-sm mb-2">
                                <div class="flex justify-between items-start">
                                    <h5 class="font-medium text-gray-800">SEO Optimization</h5>
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Marketing</span>
                                </div>
                                <p class="text-sm text-gray-600 mt-2">Research keywords and optimize content for search engines.</p>
                                <div class="mt-3 flex justify-between items-center">
                                    <div class="flex items-center">
                                        <div class="h-6 w-6 rounded-full bg-yellow-500 flex items-center justify-center text-xs text-white">MT</div>
                                    </div>
                                    <span class="text-xs text-gray-500">Due: Jun 15</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- In Progress Column -->
                    <div>
                        <div class="bg-blue-100 p-3 rounded-t-md">
                            <div class="flex justify-between items-center">
                                <h4 class="font-medium">In Progress</h4>
                                <span class="px-2 py-1 bg-blue-200 rounded-full text-xs text-blue-700">3</span>
                            </div>
                        </div>
                        <div class="bg-gray-50 p-2 rounded-b-md min-h-[400px]">
                            <!-- Task Card -->
                            <div class="bg-white p-3 rounded-md shadow-sm mb-2">
                                <div class="flex justify-between items-start">
                                    <h5 class="font-medium text-gray-800">Develop Navigation</h5>
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Development</span>
                                </div>
                                <p class="text-sm text-gray-600 mt-2">Implement responsive navigation menu with dropdown functionality.</p>
                                <div class="mt-3 flex justify-between items-center">
                                    <div class="flex items-center">
                                        <div class="h-6 w-6 rounded-full bg-indigo-500 flex items-center justify-center text-xs text-white">JD</div>
                                    </div>
                                    <span class="text-xs text-gray-500">Due: Jun 5</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Completed Column -->
                    <div>
                        <div class="bg-green-100 p-3 rounded-t-md">
                            <div class="flex justify-between items-center">
                                <h4 class="font-medium">Completed</h4>
                                <span class="px-2 py-1 bg-green-200 rounded-full text-xs text-green-700">2</span>
                            </div>
                        </div>
                        <div class="bg-gray-50 p-2 rounded-b-md min-h-[400px]">
                            <!-- Task Card -->
                            <div class="bg-white p-3 rounded-md shadow-sm mb-2">
                                <div class="flex justify-between items-start">
                                    <h5 class="font-medium text-gray-800">Project Setup</h5>
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Development</span>
                                </div>
                                <p class="text-sm text-gray-600 mt-2">Initialize project repository and set up development environment.</p>
                                <div class="mt-3 flex justify-between items-center">
                                    <div class="flex items-center">
                                        <div class="h-6 w-6 rounded-full bg-indigo-500 flex items-center justify-center text-xs text-white">JD</div>
                                    </div>
                                    <span class="text-xs text-gray-500">Completed</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
