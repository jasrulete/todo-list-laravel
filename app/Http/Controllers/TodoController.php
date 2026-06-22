<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = auth()->user()->todos()->orderBy('id', 'desc')->get();
        return view('todos.index', ['todos' => $todos]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required|string',
            'due_date' => 'nullable|date',
            'priority' => 'required|in:low,medium,high',
        ]);

        auth()->user()->todos()->create([
            'task' => $request->task,
            'due_date' => $request->due_date,
            'priority' => $request->priority,
        ]);

        return redirect('/');
    }

    public function edit(Todo $todo)
    {
        abort_if($todo->user_id !== auth()->id(), 403);
        return view('todos.edit', ['todo' => $todo]);
    }

    public function update(Request $request, Todo $todo)
    {
        abort_if($todo->user_id !== auth()->id(), 403);

        $request->validate([
            'task' => 'required|string',
            'due_date' => 'nullable|date',
            'priority' => 'required|in:low,medium,high',
        ]);

        $todo->update([
            'task' => $request->task,
            'due_date' => $request->due_date,
            'priority' => $request->priority,
        ]);

        return redirect('/');
    }

    public function toggle(Todo $todo)
    {
        abort_if($todo->user_id !== auth()->id(), 403);
        $todo->update(['done' => !$todo->done]);
        return redirect('/');
    }

    public function destroy(Todo $todo)
    {
        abort_if($todo->user_id !== auth()->id(), 403);
        $todo->delete();
        return redirect('/');
    }
}