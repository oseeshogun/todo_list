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
        $userId = auth()->user()->id;
        $tasks = Task::where('user_id', $userId)->get();
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
        $userId = auth()->user()->id;
        $task = Task::find($id);
     
        if ($task->user_id !== $userId) {
            return response()->json(["message" => "Vous n'avez pas le droit de modifier cette tâche"], 403);
        }

        $updatedTask = Task::where('id', $id)->update([
            'text' => $request->safe()->text
        ]);
     
        return response()->json($updatedTask);
    }

    public function destroy(Request $request, $id)
    {
        $userId = auth()->user()->id;

        $task = Task::find($id);
     
        if ($task->user_id !== $userId) {
            return response()->json(["message" => "Vous n'avez pas le droit de supprimer cette tâche"], 403);
        }
        
        $task = Task::where('id', $id)->delete();

        return response()->json($task);
    }

    public function toggleFinished(MarkTaskFinishedRequest $request, $id)
    {
        $userId = auth()->user()->id;
        $task = Task::where('id', $id)->where('user_id', $userId)->update([
            'finished' => $request->finished
        ]);

        return response()->json($task);
    }
}
