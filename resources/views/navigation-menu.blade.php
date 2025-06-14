@props(['active'])

<div class="h-screen w-64 bg-gray-800 text-white fixed left-0 top-0 overflow-y-auto flex flex-col">
    <div class="p-4 border-b border-gray-700">
        <div class="flex items-center justify-between">
            <div class="text-xl font-bold">Taskly</div>
            <div x-data="{ open: false }" class="md:hidden">
                <button @click="open = !open" class="text-gray-300 hover:text-white">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
            <div class="mt-4">
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-3 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white rounded-md">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span>{{ Auth::user()->currentTeam->name }}</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" :class="{'rotate-180': open}" class="h-4 w-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="open" @click.away="open = false" class="absolute z-50 mt-2 w-full bg-white rounded-md shadow-lg py-1">
                        <div class="px-4 py-2 text-xs text-gray-500">
                            {{ __('Manage Team') }}
                        </div>

                        <a href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            {{ __('Team Settings') }}
                        </a>

                        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                            <a href="{{ route('teams.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                {{ __('Create New Team') }}
                            </a>
                        @endcan

                        @if (Auth::user()->allTeams()->count() > 1)
                            <div class="border-t border-gray-200"></div>
                            <div class="px-4 py-2 text-xs text-gray-500">
                                {{ __('Switch Teams') }}
                            </div>

                            @foreach (Auth::user()->allTeams() as $team)
                                <x-switchable-team :team="$team" />
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>

    <nav class="mt-4 flex-1">
        <div class="space-y-1 flex flex-col">
            <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white {{ request()->routeIs('home') ? 'bg-gray-700 text-white' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Home
            </x-nav-link>

            <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white {{ request()->routeIs('dashboard') ? 'bg-gray-700 text-white' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                Dashboard
            </x-nav-link>

            <div x-data="{ open: false }" class="relative">
                <a href="{{ route('notifications.index') }}" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white {{ request()->routeIs('notifications.index') ? 'bg-gray-700 text-white' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span class="flex-1">Notifications</span>
                    @livewire('notification-count')
                </a>
            </div>

            <div x-data="{ open: false }">
                <button @click="open = !open" class="w-full flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white {{ request()->routeIs('projects.*') ? 'bg-gray-700 text-white' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                    </svg>
                    <span class="flex-1 text-left">Projects</span>
                    <svg xmlns="http://www.w3.org/2000/svg" :class="{'rotate-180': open}" class="h-4 w-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" class="pl-6 mt-1 space-y-1">
                    <a href="{{ route('projects.index') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white {{ request()->routeIs('projects.index') ? 'bg-gray-700 text-white' : '' }}">
                        All Projects
                    </a>
                    @php
                        $currentTeam = Auth::user()->currentTeam;
                        if ($currentTeam) {
                            $projects = $currentTeam->projects;
                        } else {
                            $teamIds = Auth::user()->teams->pluck('id');
                            $projects = Project::whereIn('team_id', $teamIds)->get();
                        }
                    @endphp
                    @foreach ($projects as $project)
                        <a href="{{ route('projects.kanban', ['project' => $project->id]) }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white {{ request()->routeIs('projects.kanban') && request()->route('project') == $project->id ? 'bg-gray-700 text-white' : '' }}">
                            {{ $project->title }}
                        </a>
                    @endforeach
                </div>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                <x-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white {{ request()->routeIs('api-tokens.index') ? 'bg-gray-700 text-white' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                    </svg>
                    API Tokens
                </x-nav-link>
            @endif
        </div>
    </nav>

    <div class="mt-auto space-y-2 p-4 border-t border-gray-700">
        <x-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white {{ request()->routeIs('profile.show') ? 'bg-gray-700 text-white' : '' }}">
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <img class="h-8 w-8 rounded-full mr-2" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
            @else
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            @endif
            {{ Auth::user()->name }}
        </x-nav-link>

        <form method="POST" action="{{ route('logout') }}" x-data>
            @csrf
            <button type="submit" class="w-full flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</div>
