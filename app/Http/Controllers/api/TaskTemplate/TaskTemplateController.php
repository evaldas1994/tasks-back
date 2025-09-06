<?php

namespace App\Http\Controllers\api\TaskTemplate;

use App\Http\Controllers\Controller;
use App\Models\TaskTemplate;
use Illuminate\Http\Request;

class TaskTemplateController extends Controller
{
    public function index()
    {
        return TaskTemplate::all();
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
}
