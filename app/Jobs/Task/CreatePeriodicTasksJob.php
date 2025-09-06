<?php

namespace App\Jobs\Task;

use App\Models\Status;
use App\Models\Task;
use App\Models\TaskTemplate;
use Carbon\Carbon;
use Database\Seeders\StatusSeeder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class CreatePeriodicTasksJob implements ShouldQueue
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
        $taskTemplates = TaskTemplate::all();
        $statusId = Status::first()->id;

        $day = Carbon::now()->isoWeekday();

        foreach ($taskTemplates as $taskTemplate) {
            if (!in_array($day, $taskTemplate->week_days))
                continue;

            $taskTemplate->tasks()->create([
                'task_template_id' => $taskTemplate->id,
                'status_id' => $statusId,
            ]);
        }
    }
}
