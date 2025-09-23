<?php

namespace App\Jobs\Task;

use App\Models\Status;
use App\Models\Task;
use App\Models\TaskTemplate;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Queue\Queueable;

class CreatePeriodicTasksJob implements ShouldQueue
{
    use Queueable;

    private Collection $taskTemplates;
    private int $statusId;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->taskTemplates = TaskTemplate::all();
        $this->statusId = Status::first()->id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->createPeriodicTask(Carbon::today());
        $this->createPeriodicTask(Carbon::tomorrow());
    }

    private function createPeriodicTask($date)
    {
        $day = $date->isoWeekday();
        $date = $date->toDateString();

        foreach ($this->taskTemplates as $taskTemplate) {
            if (!in_array($day, $taskTemplate->week_days))
                continue;


            if (Task::isAlreadyCreated($taskTemplate->id, $date))
                continue;

            $taskTemplate->tasks()->create([
                'task_template_id' => $taskTemplate->id,
                'status_id' => $this->statusId,
                'term_at' => Carbon::parse($date)->endOfDay(),
            ]);
        }
    }
}
