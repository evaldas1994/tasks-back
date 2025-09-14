<?php

namespace App\Jobs\Task;

use App\Models\Status;
use App\Models\Task;
use App\Models\TaskTemplate;
use Carbon\Carbon;
use Database\Seeders\StatusSeeder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class UpdateUncompletedTasksJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $date = Carbon::yesterday();

        $tasks = Task::forAutoClose($date)->get();

        foreach ($tasks as $task) {
            $task->setUncompleted();
            $task->taskTemplate->resetStreak();
        }
    }
}
