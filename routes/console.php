<?php

use App\Jobs\Task\CounterJob;
use App\Jobs\Task\CreatePeriodicTasksJob;
use App\Jobs\Task\UpdateUncompletedTasksJob;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

RateLimiter::for('api', function ($request) {
    return Limit::perMinute(60)->by($request->ip());
});

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Schedule::job(new CounterJob())->everyMinute();
Schedule::job(new UpdateUncompletedTasksJob())->dailyAt('00:00');
Schedule::job(new CreatePeriodicTasksJob)->dailyAt('00:10');
