<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Team Settings') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if (Auth::user()->belongsToTeam($team) && Auth::user()->hasTeamRole($team, 'owner'))
                @livewire('teams.update-team-name-form', ['team' => $team])
                @livewire('teams.team-member-manager', ['team' => $team])

                @if (Gate::check('delete', $team) && ! $team->personal_team)
                    <x-section-border />
                    <div class="mt-10 sm:mt-0">
                        @livewire('teams.delete-team-form', ['team' => $team])
                    </div>
                @endif
            @else
                <!-- Team Information -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-medium text-gray-900">
                                {{ $team->name }}
                            </h3>
                            @if(Auth::user()->belongsToTeam($team))
                            <span class="px-3 py-1 text-sm rounded-full bg-gray-100 text-gray-800">
                                    {{ Auth::user()->teamRole($team)->name }}
                            </span>
                            @endif
                        </div>

                        <!-- Team Members List -->
                        <div class="mt-6">
                            <h4 class="text-sm font-medium text-gray-500 mb-4">
                                {{ __('Team Members') }}
                            </h4>
                            <div class="space-y-4">
                                @foreach ($team->allUsers() as $user)
                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                        <div class="flex items-center">
                                            <img class="h-10 w-10 rounded-full" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" />
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $user->name }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $user->email }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <span class="px-3 py-1 text-sm rounded-full
                                                @if($user->teamRole($team)->key === 'owner') bg-purple-100 text-purple-800
                                                @elseif($user->teamRole($team)->key === 'editor') bg-blue-100 text-blue-800
                                                @else bg-green-100 text-green-800
                                                @endif">
                                                {{ $user->teamRole($team)->name }}
                                            </span>
                                            @if($user->id === $team->user_id)
                                                <span class="px-3 py-1 text-sm rounded-full bg-yellow-100 text-yellow-800">
                                                    Team Owner
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Leave Team Button -->
                        @if(Auth::user()->belongsToTeam($team) && Auth::user()->id !== $team->user_id)
                            <div class="mt-6">
                                <button type="button" onclick="document.getElementById('leave-team-modal').classList.remove('hidden')" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition">
                                    {{ __('Leave Team') }}
                                </button>
                            </div>

                            <!-- Confirmation Modal -->
                            <div id="leave-team-modal" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50 hidden">
                                <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                                    <h2 class="text-lg font-semibold mb-4">{{ __('Leave Team') }}</h2>
                                    <p class="mb-6">{{ __('Are you sure you want to leave this team?') }}</p>
                                    <div class="flex justify-end space-x-2">
                                        <button type="button" onclick="document.getElementById('leave-team-modal').classList.add('hidden')" class="px-4 py-2 bg-gray-200 rounded-md text-gray-700 hover:bg-gray-300">{{ __('Cancel') }}</button>
                                        <form method="POST" action="{{ route('teams.leave', $team) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">{{ __('Leave') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
