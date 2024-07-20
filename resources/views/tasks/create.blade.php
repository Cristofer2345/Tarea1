@extends('layouts.app')
@section('content')
<h1>Creado una tarea</h1>
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
<form action="/tasks" method="POST">
    @csrf
    <div>
        <label class="form-label" for="name">Nombre</label>
        <input class="form-control" type="text" name="name" id="name">
        @error('name')
            <p>{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="form-label" for="name">Prioridad</label>
        <select name="priority_id" id="priority_id" class="form-control">
            @foreach($priorities as $priority)
                <option value="{{ $priority->id }}">{{ $priority->name }}</option>
            @endforeach
            
        </select>
        @error('priority_id')
            <p>{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="form-label" for="User_id">Usuario</label>
        <input type="text" class="form-control" name="User_id" value="{{ Auth::user()->name }}" readonly>
        <input type="hidden" name="User_id" value="{{ Auth::user()->id }}">
    </div>
    <select name="tags[]" id="tags" multiple>
        @foreach($tipoTarea as $tag)
            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
        @endforeach
    </select>
    <div>
        <label class="form-label" for="description">Descripción</label>
        <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
        @error('description')
            <p>{{ $message }}</p>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Crear tarea</button>
</form>
@endsection