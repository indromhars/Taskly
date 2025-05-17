<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Projects') }}
                </h2>
                <p class="text-gray-600 mt-1">Manage your projects and team collaboration</p>
            </div>
            <a href="{{ route('projects.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                New Project
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Project Filters -->
            <div class="bg-white rounded-lg shadow-md p-4 mb-6">
                <div class="flex flex-wrap items-center justify-between">
                    <div class="flex space-x-4 mb-4 md:mb-0">
                        <button class="px-4 py-2 bg-indigo-600 text-white rounded-md">All</button>
                        <button class="px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md">Active</button>
                        <button class="px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md">Completed</button>
                        <button class="px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md">Archived</button>
                    </div>
                    <div class="w-full md:w-auto">
                        <div class="relative">
                            <input type="text" placeholder="Search projects..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Projects Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Project Card 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="h-3 bg-indigo-600"></div>
                    <div class="p-5">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Website Redesign</h3>
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Active</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-4">Redesigning the company website with new branding and improved user experience.</p>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-2 text-sm text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                <span>12 tasks</span>
                            </div>
                            <div class="flex items-center space-x-2 text-sm text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>Due in 10 days</span>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <div class="flex justify-between items-center">
                                <div class="flex -space-x-2">
                                    <div class="h-8 w-8 rounded-full bg-indigo-500 border-2 border-white flex items-center justify-center text-xs text-white">JD</div>
                                    <div class="h-8 w-8 rounded-full bg-green-500 border-2 border-white flex items-center justify-center text-xs text-white">AK</div>
                                    <div class="h-8 w-8 rounded-full bg-yellow-500 border-2 border-white flex items-center justify-center text-xs text-white">MT</div>
                                </div>
                                <a href="#" class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-md text-sm hover:bg-indigo-200">View</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Project Card 2 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="h-3 bg-purple-600"></div>
                    <div class="p-5">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Mobile App Development</h3>
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Active</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-4">Building a new mobile application for both iOS and Android platforms.</p>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-2 text-sm text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                <span>18 tasks</span>
                            </div>
                            <div class="flex items-center space-x-2 text-sm text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>Due in 30 days</span>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <div class="flex justify-between items-center">
                                <div class="flex -space-x-2">
                                    <div class="h-8 w-8 rounded-full bg-red-500 border-2 border-white flex items-center justify-center text-xs text-white">SL</div>
                                    <div class="h-8 w-8 rounded-full bg-blue-500 border-2 border-white flex items-center justify-center text-xs text-white">RJ</div>
                                </div>
                                <a href="#" class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-md text-sm hover:bg-indigo-200">View</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Project Card 3 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="h-3 bg-green-600"></div>
                    <div class="p-5">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Marketing Campaign</h3>
                            <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">Completed</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-4">Q2 marketing campaign planning and execution for product launch.</p>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-2 text-sm text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                <span>8 tasks</span>
                            </div>
                            <div class="flex items-center space-x-2 text-sm text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>Completed</span>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <div class="flex justify-between items-center">
                                <div class="flex -space-x-2">
                                    <div class="h-8 w-8 rounded-full bg-purple-500 border-2 border-white flex items-center justify-center text-xs text-white">KP</div>
                                    <div class="h-8 w-8 rounded-full bg-pink-500 border-2 border-white flex items-center justify-center text-xs text-white">LM</div>
                                    <div class="h-8 w-8 rounded-full bg-indigo-500 border-2 border-white flex items-center justify-center text-xs text-white">JD</div>
                                </div>
                                <a href="#" class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-md text-sm hover:bg-indigo-200">View</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Project Card 4 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="h-3 bg-yellow-600"></div>
                    <div class="p-5">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Customer Portal</h3>
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Active</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-4">Building a portal for customers to manage their accounts and access reports.</p>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-2 text-sm text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                <span>15 tasks</span>
                            </div>
                            <div class="flex items-center space-x-2 text-sm text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>Due in 45 days</span>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <div class="flex justify-between items-center">
                                <div class="flex -space-x-2">
                                    <div class="h-8 w-8 rounded-full bg-indigo-500 border-2 border-white flex items-center justify-center text-xs text-white">JD</div>
                                    <div class="h-8 w-8 rounded-full bg-purple-500 border-2 border-white flex items-center justify-center text-xs text-white">KP</div>
                                </div>
                                <a href="#" class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-md text-sm hover:bg-indigo-200">View</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
