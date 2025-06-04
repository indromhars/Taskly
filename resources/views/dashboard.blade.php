<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <p class="text-gray-600 mt-1">Welcome to your summaries of work!</p>
    </x-slot>

    <livewire:dashboard />
</x-app-layout>
