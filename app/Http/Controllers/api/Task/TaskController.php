<?php

namespace App\Http\Controllers\api\Task;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Models\TaskTemplate;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('taskTemplate')
            ->whereHas('taskTemplate', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->whereIn('status_id', [1, 2])
            ->get();

        return TaskResource::collection($tasks);
    }

    public function store(Request $request)
    {
        $data = $request->input();
        $data['user_id'] = auth()->id();

        return TaskTemplate::create($data);
    }

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }

    public function complete(Task $task)
    {
        $task->setCompleted();
        $task->taskTemplate->addStreak();

        return response()->json([
            'message' => 'Task completed successfully',
            'task' => $task
        ]);
    }
}
