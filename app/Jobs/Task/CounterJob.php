<?php

namespace App\Jobs\Task;

use App\Models\Status;
use App\Models\SystemParameter;
use App\Models\Task;
use App\Models\TaskTemplate;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class CounterJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $counter = SystemParameter::getValue('job_counter');
        $counter++;

        SystemParameter::setValue('job_counter', $counter);
    }
}
