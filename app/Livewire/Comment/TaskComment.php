<?php

namespace App\Livewire\Comment;

use App\Models\Comment;
use App\Models\Task;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TaskCommentedNotification;

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

        $comment = $this->task->comments()->create([
            'user_id' => Auth::id(),
            'content' => $this->newComment,
        ]);

        // Get the current user who commented
        $commentedBy = Auth::user();

        // Get all users in the current team
        $team = $commentedBy->currentTeam;
        if ($team) {
            // Get all users in the current team, excluding the commenter
            $usersToNotify = $team->allUsers()->where('id', '!=', $commentedBy->id);

            // Notify all relevant users
            Notification::send($usersToNotify, new TaskCommentedNotification($this->task, $comment, $commentedBy));

            // Optionally, notify the commenter as well
            Notification::send($commentedBy, new TaskCommentedNotification($this->task, $comment, $commentedBy));
        }

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
