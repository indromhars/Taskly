<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <p class="text-gray-600 mt-1">Welcome to your summaries of work!</p>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Weekly Stats Section -->
            <div class="mb-8">
                <x-weekly-stats />
            </div>

            <div class="border-t border-gray-200 my-8"></div>

            <!-- Weekly Timeline Section -->
            <div>
                <x-weekly-timeline />
            </div>
        </div>
    </div>
</x-app-layout>
