<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public $totalTasks;
    public $completedTasks;
    public $overdueTasks;
    public $upcomingTasks;
    public $tasksByPriority;
    public $tasksByStatus;
    public $recentTasks;
    public $teamTasks;
    public $debugInfo = [];

    public function mount()
    {
        $this->loadStatistics();
    }

    public function loadStatistics()
    {
        $user = Auth::user();
        $userId = $user->id;
        $teamIds = $user->teams->pluck('id')->toArray();

        if (empty($teamIds)) {
            $this->totalTasks = 0;
            $this->completedTasks = 0;
            $this->overdueTasks = 0;
            $this->upcomingTasks = 0;
            $this->tasksByPriority = [];
            $this->tasksByStatus = [];
            $this->recentTasks = collect();
            $this->teamTasks = collect();
            return;
        }

        // Get all tasks for the user's teams and assigned to the user
        $query = Task::whereHas('project', function ($query) use ($teamIds) {
            $query->whereIn('team_id', $teamIds);
        })->where('assignee_id', $userId);

        // Total tasks
        $this->totalTasks = $query->count();

        // Completed tasks (last 30 days)
        $this->completedTasks = (clone $query)
            ->where('status', 'done')
            ->where('updated_at', '>=', Carbon::now()->subDays(30))
            ->count();

        // Overdue tasks
        $this->overdueTasks = (clone $query)
            ->where('status', '!=', 'done')
            ->where('due_date', '<', Carbon::now())
            ->count();

        // Upcoming tasks (next 7 days)
        $this->upcomingTasks = (clone $query)
            ->where('status', '!=', 'done')
            ->where('due_date', '>=', Carbon::now())
            ->where('due_date', '<=', Carbon::now()->addDays(7))
            ->count();

        // Tasks by priority
        $this->tasksByPriority = (clone $query)
            ->selectRaw('priority, count(*) as count')
            ->groupBy('priority')
            ->get()
            ->pluck('count', 'priority')
            ->toArray();

        // Tasks by status
        $this->tasksByStatus = (clone $query)
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->get()
            ->pluck('count', 'status')
            ->toArray();

        // Recent tasks
        $this->recentTasks = (clone $query)
            ->with(['project', 'user'])
            ->latest()
            ->take(5)
            ->get();

        // Team tasks overview
        $this->teamTasks = Project::whereIn('team_id', $teamIds)
            ->where('team_id', $user->currentTeam->id)
            ->withCount(['tasks' => function ($query) use ($userId) {
                $query->where('status', '!=', 'done')->where('assignee_id', $userId);
            }])
            ->orderBy('tasks_count', 'desc')
            ->take(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
