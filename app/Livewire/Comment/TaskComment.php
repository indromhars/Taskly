<?php

namespace App\Livewire\Comment;

use App\Models\Comment;
use App\Models\Task;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class TaskComment extends ModalComponent
{
    public Task $task;
    public string $newComment = '';

    public function mount(Task $task)
    {
        $this->task = $task;
    }

    public function addComment()
    {
        $this->validate([
            'newComment' => 'required|min:3',
        ]);

        $this->task->comments()->create([
            'user_id' => Auth::id(),
            'content' => $this->newComment,
        ]);

        $this->newComment = '';
        $this->dispatch('commentAdded');
    }

    public function render()
    {
        return view('livewire.comment.comment', [
            'comments' => $this->task->comments()->with('user')->latest()->get(),
        ]);
    }
}
