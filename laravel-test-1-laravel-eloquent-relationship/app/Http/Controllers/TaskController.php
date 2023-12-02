<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('user')->paginate();

        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        auth()->user()->tasks()->create([
            'name' => $request->name
        ]);

        return 'Success';
    }
}