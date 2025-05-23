<div class="space-y-4 p-6">
    <h2 class="text-lg font-semibold mb-4">Delete Project</h2>
    <p class="text-sm text-gray-500">
        Are you sure you want to delete the project "{{ $title }}"? This action cannot be undone.
    </p>

    <div class="flex justify-end space-x-3 mt-6">
        <x-secondary-button wire:click="closeModal">
            {{ __('Cancel') }}
        </x-secondary-button>
        <x-danger-button wire:click="delete" wire:loading.attr="disabled">
            {{ __('Delete') }}
        </x-danger-button>
    </div>
</div>
