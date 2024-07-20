@extends('layouts.app')
@section('content')
<h1>Editando tarea ID: {{ $task->id }}</h1>
<hr>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="/tasks/{{ $task->id }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label class="form-label" for="name">Nombre</label>
        <input class="form-control" type="text" name="name" id="name" value="{{ $task->name }}">
        @error('name')
            <p>{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="form-label" for="User_id">Usuario</label>
        <input type="text" class="form-control" name="User_id" value="{{ Auth::user()->name }}" readonly>
        <input type="hidden" name="User_id" value="{{ Auth::user()->id }}">
    </div>
    <select class="form-select" name="priority" id="priority" required>
        <option value="">Selecciona una prioridad</option>
        @foreach ($priority as $priority)
            <option value="{{ $priority->id }}" {{ $task->priority_id == $priority->id ? 'selected' : '' }}>
                {{ $priority->name }}
            </option>
        @endforeach
    </select>
    <div>
        <label class="form-label" for="tipoTarea">Tipo de Tarea</label>
        <select class="form-select" name="tipoTareas[]" id="tipoTarea" required multiple>
            @foreach ($tipotarea as $tipo)
                <option value="{{ $tipo->id }}" {{ $task->idTarea == $tipo->id ? 'selected' : '' }}>
                    {{ $tipo->name }}
                </option>
            @endforeach
        </select>
        @error('tipoTarea')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="form-label" for="description">Descripción</label>
        <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{ $task->description }}</textarea>
        @error('description')
            <p>{{ $message }}</p>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Actualizar</button>
</form>
@endsection