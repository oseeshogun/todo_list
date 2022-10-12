<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth.api'])->except('index');
        $this->middleware(['auth'])->only('index');
    }

    public function index()
    {
        return view('home');
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

        $task = Task::where('id', $id)->update([
            'text' => $request->text
        ]);

        return response()->json($task);
    }
}
