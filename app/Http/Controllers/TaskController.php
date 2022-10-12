<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\MarkTaskFinishedRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function getAll(Request $request)
    {
        $user_id = auth()->user()->id;
        $tasks = Task::where('user_id', '=', $user_id)->get();
        return response()->json($tasks);
    }

    public function store(CreateTaskRequest $request)
    {

        $task = $request->user()->tasks()->create([
            'text' => $request->safe()->text
        ]);

        return response()->json($task);
    }

    public function update(CreateTaskRequest $request, $id)
    {
        $user_id = auth()->user()->id;
        $task = Task::where('id', $id)->where('user_id', $user_id)->update([
            'text' => $request->safe()->text
        ]);

        return response()->json($task);
    }

    public function destroy(Request $request, $id)
    {
        $user_id = auth()->user()->id;
        $task = Task::where('id', $id)->where('user_id', $user_id)->delete();

        return response()->json($task);
    }

    public function mark_as_finished(MarkTaskFinishedRequest $request, $id)
    {
        $user_id = auth()->user()->id;
        $task = Task::where('id', $id)->where('user_id', $user_id)->update([
            'finished' => $request->finished
        ]);

        return response()->json($task);
    }
}
