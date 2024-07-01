<?php

namespace App\Http\Controllers;

use App\Models\Priority;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {

        $tasks = Task::all();

        return view('tasks.index', [
            'tasks' => $tasks
        ]);
    }

    public function create()
    {

        return view('tasks.create',[
            'priorities' => Priority::all(),
            'user' => User::all()
        ]);
    }

    public function show(Task $task)
    {

        return view('tasks.show', [
            'task' => $task
        ]);
    }

    public function store()
    {

        // $task = new Task();

        // $task->name = request('name'); 
        // $task->description = request('description');

        // $task->save();
        $data = request()->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'description' => ['required', 'min:3'],
            'priority_id' => 'required|exists:priorities,id',
            'User_id' => 'required|exists:users,id'
        ]);

        Task::create($data);

        return redirect('/tasks');
    }

    public function edit(Task $task)
    {

        return view('tasks.edit', [
            'task' => $task
        ]);
    }

    public function update(Task $task)
    {

        $data = request()->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'description' => ['required', 'min:3']
        ]);

       $task->fill($data)->save();
       //$task->update($data);

        return redirect('/tasks/' . $task->id);
    }
    public function completed(Task $task)
    {
        $task->completed = 1;
        $task->save();
        return redirect('/tasks/');
    }
}
