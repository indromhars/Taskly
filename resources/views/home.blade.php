<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
        <p class="text-gray-600 mt-1">Your activity overview</p>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Stats Card 1 -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-indigo-100 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Active Projects</p>
                            <h4 class="text-2xl font-bold text-gray-800">8</h4>
                        </div>
                    </div>
                </div>

                <!-- Stats Card 2 -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Tasks Completed</p>
                            <h4 class="text-2xl font-bold text-gray-800">24</h4>
                        </div>
                    </div>
                </div>

                <!-- Stats Card 3 -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Pending Tasks</p>
                            <h4 class="text-2xl font-bold text-gray-800">12</h4>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Projects Section -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold mb-4">Recent Projects</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Project Card 1 -->
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <div class="flex justify-between items-start">
                            <h4 class="font-medium text-gray-800">Website Redesign</h4>
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Active</span>
                        </div>
                        <p class="text-sm text-gray-600 mt-2">Redesigning the company website with new branding and improved user experience.</p>
                        <div class="mt-4 flex justify-between items-center">
                            <div class="flex -space-x-2">
                                <div class="h-6 w-6 rounded-full bg-indigo-500 border border-white flex items-center justify-center text-xs text-white">JD</div>
                                <div class="h-6 w-6 rounded-full bg-green-500 border border-white flex items-center justify-center text-xs text-white">AK</div>
                                <div class="h-6 w-6 rounded-full bg-yellow-500 border border-white flex items-center justify-center text-xs text-white">MT</div>
                            </div>
                            <a href="#" class="text-sm text-indigo-600 hover:text-indigo-800">View</a>
                        </div>
                    </div>

                    <!-- Project Card 2 -->
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <div class="flex justify-between items-start">
                            <h4 class="font-medium text-gray-800">Mobile App Development</h4>
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Active</span>
                        </div>
                        <p class="text-sm text-gray-600 mt-2">Building a new mobile application for both iOS and Android platforms.</p>
                        <div class="mt-4 flex justify-between items-center">
                            <div class="flex -space-x-2">
                                <div class="h-6 w-6 rounded-full bg-red-500 border border-white flex items-center justify-center text-xs text-white">SL</div>
                                <div class="h-6 w-6 rounded-full bg-blue-500 border border-white flex items-center justify-center text-xs text-white">RJ</div>
                            </div>
                            <a href="#" class="text-sm text-indigo-600 hover:text-indigo-800">View</a>
                        </div>
                    </div>

                    <!-- Project Card 3 -->
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <div class="flex justify-between items-start">
                            <h4 class="font-medium text-gray-800">Marketing Campaign</h4>
                            <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">Completed</span>
                        </div>
                        <p class="text-sm text-gray-600 mt-2">Q2 marketing campaign planning and execution for product launch.</p>
                        <div class="mt-4 flex justify-between items-center">
                            <div class="flex -space-x-2">
                                <div class="h-6 w-6 rounded-full bg-purple-500 border border-white flex items-center justify-center text-xs text-white">KP</div>
                                <div class="h-6 w-6 rounded-full bg-pink-500 border border-white flex items-center justify-center text-xs text-white">LM</div>
                                <div class="h-6 w-6 rounded-full bg-indigo-500 border border-white flex items-center justify-center text-xs text-white">JD</div>
                            </div>
                            <a href="#" class="text-sm text-indigo-600 hover:text-indigo-800">View</a>
                        </div>
                    </div>
                </div>
                <div class="mt-4 text-right">
                    <a href="{{ route('projects.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">View All Projects →</a>
                </div>
            </div>

            <!-- Recent Activity Section -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Recent Activity</h3>
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <ul class="divide-y divide-gray-200">
                        <li class="p-4 hover:bg-gray-50">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mr-4">
                                    <div class="h-8 w-8 rounded-full bg-indigo-500 flex items-center justify-center text-white">JD</div>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">John Doe added a new task to <a href="#" class="text-indigo-600 hover:text-indigo-800">Website Redesign</a></p>
                                    <p class="text-sm text-gray-500">2 hours ago</p>
                                </div>
                            </div>
                        </li>
                        <li class="p-4 hover:bg-gray-50">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mr-4">
                                    <div class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center text-white">AK</div>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Anna Kim completed a task in <a href="#" class="text-indigo-600 hover:text-indigo-800">Mobile App Development</a></p>
                                    <p class="text-sm text-gray-500">5 hours ago</p>
                                </div>
                            </div>
                        </li>
                        <li class="p-4 hover:bg-gray-50">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mr-4">
                                    <div class="h-8 w-8 rounded-full bg-yellow-500 flex items-center justify-center text-white">MT</div>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Mike Thomas commented on <a href="#" class="text-indigo-600 hover:text-indigo-800">Marketing Campaign</a></p>
                                    <p class="text-sm text-gray-500">Yesterday</p>
                                </div>
                            </div>
                        </li>
                        <li class="p-4 hover:bg-gray-50">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mr-4">
                                    <div class="h-8 w-8 rounded-full bg-red-500 flex items-center justify-center text-white">SL</div>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Sarah Lee created a new project <a href="#" class="text-indigo-600 hover:text-indigo-800">Product Roadmap</a></p>
                                    <p class="text-sm text-gray-500">2 days ago</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
