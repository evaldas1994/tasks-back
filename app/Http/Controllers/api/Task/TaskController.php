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
        $tasks = Task::index(auth()->id())
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
        $task->taskTemplate->addFreeze();

        return response()->json([
            'message' => 'Task completed successfully',
            'task' => $task
        ]);
    }
}
