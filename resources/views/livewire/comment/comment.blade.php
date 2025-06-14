<div>
    <div class="bg-white rounded-lg w-full max-w-2xl h-[80vh] flex flex-col">
        <div class="p-4 border-b">
            <h2 class="text-xl font-semibold">Comments</h2>
        </div>
        <div class="flex-1 overflow-y-auto p-4 space-y-4">
            @foreach($comments as $comment)
                <div class="bg-gray-100 p-4 rounded-lg">
                    <div class="flex items-center space-x-2">
                        <span class="font-semibold">{{ $comment->user->name }}</span>
                        <span class="text-gray-500 text-sm">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="mt-2">{{ $comment->content }}</p>
                </div>
            @endforeach
        </div>
        <div class="p-4 border-t">
            <form wire:submit.prevent="addComment" class="flex space-x-2">
                <textarea wire:model="newComment" class="flex-1 p-2 border rounded" placeholder="Add a comment..."></textarea>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Post</button>
            </form>
        </div>
    </div>
</div>
