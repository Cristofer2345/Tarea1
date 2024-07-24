<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\models\Task;
use Illuminate\Validation\Rules\Can;

Route::get('/', function () { 
    $tasks = Task::all();
    return view('tasks.index',['tasks'=> $tasks]);
});

Route::get('/tasks', [TaskController::class, 'index']);
Route::get('/tasks/create', [TaskController::class, 'create'])->middleware('auth');
Route::get('/tasks/{task}', [TaskController::class, 'show']);
Route::post('/tasks', [TaskController::class, 'store']);
Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->middleware('auth');
Route::patch('/tasks/{task}/completar', [TaskController::class, 'completed']);
Route::put('/tasks/{task}', [TaskController::class, 'update']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/index', [App\Http\Controllers\TaskController::class, 'index'])->name('index');
