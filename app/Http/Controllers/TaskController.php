<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth.api'])->except('index');
    }

    public function getAll(Request $request)
    {
        $user_id = auth()->user()->id;
        $tasks = Task::where('user_id', '=', $user_id)->get();
        return response()->json($tasks);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'text' => 'required'
        ]);

        $task = $request->user()->tasks()->create([
            'text' => $request->text
        ]);

        return response()->json($task);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'text' => 'required'
        ]);

        $user_id = auth()->user()->id;
        $task = Task::where('id', $id)->where('user_id', $user_id)->update([
            'text' => $request->text
        ]);

        return response()->json($task);
    }

    public function delete(Request $request, $id)
    {
        $user_id = auth()->user()->id;
        $task = Task::where('id', $id)->where('user_id', $user_id)->delete();

        return response()->json($task);
    }

    public function make_as_finished(Request $request, $id)
    {
        $this->validate($request, [
            'finished' => 'required|boolean'
        ]);

        $user_id = auth()->user()->id;
        $task = Task::where('id', $id)->where('user_id', $user_id)->update([
            'finished' => $request->finished
        ]);

        return response()->json($task);
    }
}
