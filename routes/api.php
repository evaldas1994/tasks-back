<?php

use App\Http\Controllers\api\Auth\AuthController;
use App\Http\Controllers\api\Task\TaskController;
use App\Http\Controllers\api\TaskTemplate\TaskTemplateController;
use App\Jobs\Task\CreatePeriodicTasksJob;
use App\Jobs\Task\UpdateUncompletedTasksJob;
use Illuminate\Support\Facades\Route;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

RateLimiter::for('api', function ($request) {
    return Limit::perMinute(60)->by($request->ip());
});

// Jobs
//Route::middleware('throttle:api')->group(function () {
    Route::prefix('jobs')->group(function () {
        Route::prefix('tasks')->group(function () {
            Route::get('create-periodic-tasks-job', [CreatePeriodicTasksJob::class, 'handle']);
            Route::get('update-uncompleted-tasks-job', [UpdateUncompletedTasksJob::class, 'handle']);
        });
    });
//});

// Atviras route tik store funkcijai
//Route::middleware('throttle:api')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
    });
//});

//Route::middleware('auth:sanctum', 'throttle:api')->group(function () {
    Route::apiResource('task-templates', TaskTemplateController::class);
    Route::apiResource('tasks', TaskController::class);
    Route::get('tasks/{task}/complete', [TaskController::class, 'complete']);
//});

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
