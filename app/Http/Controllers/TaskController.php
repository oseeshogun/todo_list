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
        $tasks = $request->user()->tasks();
        return response()->json($tasks);
    }

    // public function create(Request $request) {
    //     $this->validate($request, [
    //         'text' => 'required'
    //     ])
    // }
}
