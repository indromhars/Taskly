<div class="p-6">
    <h2 class="text-lg font-medium text-gray-900 mb-4">
        Create New Task
    </h2>

    <form wire:submit="create" class="space-y-4">
        <div>
            <x-label for="title" value="{{ __('Title') }}" />
            <x-input wire:model="title" id="title" type="text" class="mt-1 block w-full" />
            <x-input-error for="title" class="mt-2" />
        </div>

        <div>
            <x-label for="description" value="{{ __('Description') }}" />
            <textarea
                wire:model="description"
                id="description"
                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                rows="3"
            ></textarea>
            <x-input-error for="description" class="mt-2" />
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <x-label for="status" value="{{ __('Status') }}" />
                <select
                    wire:model="status"
                    id="status"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                >
                    <option value="todo">To Do</option>
                    <option value="in_progress">In Progress</option>
                    <option value="done">Done</option>
                </select>
                <x-input-error for="status" class="mt-2" />
            </div>

            <div>
                <x-label for="priority" value="{{ __('Priority') }}" />
                <select
                    wire:model="priority"
                    id="priority"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                >
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
                <x-input-error for="priority" class="mt-2" />
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <x-label for="due_date" value="{{ __('Due Date') }}" />
                <x-input wire:model="due_date" id="due_date" type="date" class="mt-1 block w-full" />
                <x-input-error for="due_date" class="mt-2" />
            </div>

<div>
                <x-label for="assignee_id" value="{{ __('Assignee') }}" />
                <select
                    wire:model="assignee_id"
                    id="assignee_id"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                >
                    <option value="">Unassigned</option>
                    @foreach($project->team->allUsers() as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="assignee_id" class="mt-2" />
            </div>
        </div>

        <div class="flex justify-end space-x-3 mt-6">
            <x-secondary-button wire:click="$dispatch('closeModal')" type="button">
                {{ __('Cancel') }}
            </x-secondary-button>
            <x-button wire:loading.attr="disabled">
                {{ __('Create Task') }}
            </x-button>
        </div>
    </form>
</div>
