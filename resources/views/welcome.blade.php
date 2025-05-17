<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Taskly') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-900">
        <header class="bg-gray-800 border-b border-gray-700 shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold text-white">Taskly</h1>
                </div>
                <div>
                    @if (Route::has('login'))
                        <div class="space-x-4 flex items-center">
                            @auth
                                <a href="{{ route('dashboard') }}" class="text-sm text-indigo-300 hover:text-indigo-200 transition">Dashboard</a>

                                <form method="POST" action="{{ route('logout') }}" class="inline-block">
                                    @csrf
                                    <x-button type="submit" class="bg-gray-700 hover:bg-gray-600 text-white border border-gray-600">
                                        {{ __('Log Out') }}
                                    </x-button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="text-sm text-indigo-300 hover:text-indigo-200 transition">Login</a>

                                @if (Route::has('register'))
                                    <x-button class="bg-indigo-600 hover:bg-indigo-700 text-white">
                                        <a href="{{ route('register') }}" class="text-white">Register</a>
                                    </x-button>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </header>

        <main>
            <!-- Hero Section -->
            <section class="relative overflow-hidden bg-gradient-to-r from-gray-800 to-indigo-900 text-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 flex flex-col md:flex-row items-center">
                    <div class="md:w-1/2 mb-10 md:mb-0">
                        <h2 class="text-4xl md:text-5xl font-bold mb-6">Stay on top of your projects — without the chaos.</h2>
                        <p class="text-lg md:text-xl mb-8 text-gray-200">Organize tasks, track progress visually, and get your team moving faster — all in one simple, powerful workspace.</p>
                        @auth
                            <x-button class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 text-lg">
                                <a href="{{ route('dashboard') }}">Go to Dashboard</a>
                            </x-button>
                        @else
                            <x-button class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 text-lg">
                                <a href="{{ route('register') }}">Try Taskly Free</a>
                            </x-button>
                        @endauth
                    </div>
                    <div class="md:w-1/2 md:pl-10">
                        <img src="https://placehold.co/600x400/4338ca/e0e7ff?text=Taskly+Dashboard" alt="Taskly Dashboard Preview" class="rounded-lg shadow-xl">
                    </div>
                </div>
                <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-indigo-500 rounded-full opacity-20 blur-3xl"></div>
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-purple-700 rounded-full opacity-20 blur-3xl"></div>
            </section>

            <!-- Introduction Section -->
            <section class="py-20 bg-gray-800">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-16">
                        <h2 class="text-3xl font-bold text-white mb-4">Meet <span class="text-indigo-400">Taskly</span></h2>
                        <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                            Taskly helps small teams work smarter — not harder. Plan your projects, break down tasks, and track everything in a clean, visual way with a simple Kanban Board.
                        </p>
                    </div>
                    <div class="flex flex-col md:flex-row items-center">
                        <div class="md:w-1/2 mb-10 md:mb-0">
                            <img src="https://placehold.co/600x400/4338ca/e0e7ff?text=Kanban+Board" alt="Kanban Board" class="rounded-lg shadow-md">
                        </div>
                        <div class="md:w-1/2 md:pl-10">
                            <p class="text-lg text-gray-300 mb-6">
                                Get updates when things move, chat right inside tasks, and stay focused on what matters. No clutter, no confusion — just smooth teamwork.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Benefits Section -->
            <section class="py-20 bg-gray-900">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-16">
                        <h2 class="text-3xl font-bold text-white">Why Teams Love Taskly</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        <!-- Benefit 1 -->
                        <div class="bg-gray-800 p-6 rounded-lg shadow-md border border-gray-700">
                            <div class="h-40 bg-gray-700 rounded-md mb-4 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold mb-2 text-white">Projects, organized your way</h3>
                            <p class="text-gray-300">Create projects, add your team, and track everything flowing smoothly — without drowning in endless email threads.</p>
                        </div>

                        <!-- Benefit 2 -->
                        <div class="bg-gray-800 p-6 rounded-lg shadow-md border border-gray-700">
                            <div class="h-40 bg-gray-700 rounded-md mb-4 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold mb-2 text-white">Drag, drop, done</h3>
                            <p class="text-gray-300">Move tasks across your board from "To Do" → "In Progress" → "Done" — progress you can actually see and that will satisfy you.</p>
                        </div>

                        <!-- Benefit 3 -->
                        <div class="bg-gray-800 p-6 rounded-lg shadow-md border border-gray-700">
                            <div class="h-40 bg-gray-700 rounded-md mb-4 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold mb-2 text-white">Real teamwork, real easy</h3>
                            <p class="text-gray-300">Easily can jump in, create tasks, leave comments, and keep everyone in sync without bottlenecks or silos.</p>
                        </div>

                        <!-- Benefit 4 -->
                        <div class="bg-gray-800 p-6 rounded-lg shadow-md border border-gray-700">
                            <div class="h-40 bg-gray-700 rounded-md mb-4 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold mb-2 text-white">Fast, Light, Run anywhere</h3>
                            <p class="text-gray-300">Built to be lightning quick, whether on desktop or mobile — so your team can work wherever you need to.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CTA Section -->
            <section class="py-20 bg-gradient-to-r from-gray-800 to-indigo-900 text-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <h2 class="text-3xl font-bold mb-6">Ready to get organized?</h2>
                    <p class="text-xl mb-8 max-w-3xl mx-auto text-gray-200">Join thousands of teams using Taskly to stay on top of their projects and deliver amazing results.</p>
                    @auth
                        <x-button class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 text-lg">
                            <a href="{{ route('dashboard') }}">Go to Your Dashboard</a>
                        </x-button>
                    @else
                        <x-button class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 text-lg">
                            <a href="{{ route('register') }}">Start Your Free Trial</a>
                        </x-button>
                    @endauth
                </div>
            </section>
        </main>

        <footer class="bg-gray-950 text-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between">
                    <div class="mb-8 md:mb-0">
                        <div class="flex items-center">
                            <h2 class="text-xl font-bold">Taskly</h2>
                        </div>
                        <p class="mt-4 text-gray-400">Organize your tasks. Simplify your workflow.</p>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-8">
                        <div>
                            <h3 class="text-lg font-semibold mb-4 text-indigo-300">Product</h3>
                            <ul class="space-y-2">
                                <li><a href="#" class="text-gray-400 hover:text-indigo-300 transition">Features</a></li>
                                <li><a href="#" class="text-gray-400 hover:text-indigo-300 transition">Pricing</a></li>
                                <li><a href="#" class="text-gray-400 hover:text-indigo-300 transition">Integrations</a></li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold mb-4 text-indigo-300">Company</h3>
                            <ul class="space-y-2">
                                <li><a href="#" class="text-gray-400 hover:text-indigo-300 transition">About</a></li>
                                <li><a href="#" class="text-gray-400 hover:text-indigo-300 transition">Blog</a></li>
                                <li><a href="#" class="text-gray-400 hover:text-indigo-300 transition">Careers</a></li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold mb-4 text-indigo-300">Support</h3>
                            <ul class="space-y-2">
                                <li><a href="#" class="text-gray-400 hover:text-indigo-300 transition">Help Center</a></li>
                                <li><a href="#" class="text-gray-400 hover:text-indigo-300 transition">Contact</a></li>
                                <li><a href="#" class="text-gray-400 hover:text-indigo-300 transition">Privacy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                    <p>&copy; {{ date('Y') }} Taskly. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </body>
</html>
