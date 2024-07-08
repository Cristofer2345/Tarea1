<?php

namespace App\Http\Controllers;

use App\Models\Priority;
use App\Models\Task;
use App\Models\TipoTarea;
use App\Models\User;
use Database\Seeders\tipoTarea as SeedersTipoTarea;
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
            'user' => User::all(),
            'tipoTarea' =>TipoTarea::all()
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

        $data = request()->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'description' => ['required', 'min:3'],
            'priority_id' => 'required|exists:priorities,id',
            'User_id' => 'required|exists:users,id', 
           'tags' => 'array', // Asegúrate de que 'tags' sea un array
        'tags.*' => 'exists:tipoTarea,id',
        ]);
    
        // Crear una nueva tarea con los datos validados
        $task = Task::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'priority_id' => $data['priority_id'],
            'user_id' => $data['User_id'],
        ],);
        // Adjuntar las etiquetas (tipotarea) a la tarea
        $task->tipoTarea()->attach($data['tags']);
        $task  = Task::with(['tipoTarea'])->get();
        return redirect('/tasks');
    }

    public function edit(Task $task)
    {
       $tipotarea = TipoTarea::all();
       $priority = Priority::all();
        return view('tasks.edit', [
            'task' => $task,
             'priority'=> $priority,
             'tipotarea'=>$tipotarea
        ]);
    }

    public function update(Task $task)
    {
        $validatedData = request()->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'description' => ['required', 'min:3'],
            'tipoTareas' => ['required', 'array'], // Validación para los tipos de tarea seleccionados
            'tipoTareas.*' => ['exists:tipoTarea,id'] // Validación para cada tipo de tarea
        ]);
    
        // Actualización de los datos básicos de la tarea
        $task->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
        ]);
    
        // Actualización de la relación muchos a muchos (tipos de tarea)
        $task->tipoTarea()->sync($validatedData['tipoTareas']);
    

        return redirect('/tasks/' . $task->id);
    }
    public function completed(Task $task)
    {
        $task->completed = 1;
        $task->save();
        return redirect('/tasks/');
    }
}
