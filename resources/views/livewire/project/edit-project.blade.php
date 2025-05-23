<div class="space-y-4 p-6">
    <h2 class="text-lg font-semibold mb-4">Edit Project</h2>
    <div>
        <x-label for="title" value="{{ __('Title') }}" />
        <x-input wire:model="title" id="title" type="text" class="mt-1 block w-full" />
        <x-input-error for="title" class="mt-2" />
    </div>

    <div>
        <x-label for="description" value="{{ __('Description') }}" />
        <textarea wire:model="description" id="description" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3"></textarea>
        <x-input-error for="description" class="mt-2" />
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <x-label for="start_date" value="{{ __('Start Date') }}" />
            <x-input wire:model="start_date" id="start_date" type="date" class="mt-1 block w-full" />
            <x-input-error for="start_date" class="mt-2" />
        </div>

        <div>
            <x-label for="end_date" value="{{ __('End Date') }}" />
            <x-input wire:model="end_date" id="end_date" type="date" class="mt-1 block w-full" />
            <x-input-error for="end_date" class="mt-2" />
        </div>
    </div>

    <div class="flex justify-end space-x-3 mt-6">
        <x-secondary-button wire:click="closeModal">
            {{ __('Cancel') }}
        </x-secondary-button>
        <x-button wire:click="update" wire:loading.attr="disabled">
            {{ __('Update') }}
        </x-button>
    </div>
</div>
