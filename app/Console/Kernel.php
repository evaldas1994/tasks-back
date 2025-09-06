<?php


namespace App\Console;

use App\Jobs\Task\CreatePeriodicTasksJob;
use App\Jobs\Task\UpdateUncompletedTasksJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Schedule the application's commands.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            CreatePeriodicTasksJob::dispatch();
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');
        require base_path('routes/console.php');
    }
}
