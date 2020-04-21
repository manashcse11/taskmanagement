@extends('layouts.app')

@section('title', 'Task Create')

@section('content')
    <h3>Create Task</h3>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" id="name" name="name" value="{{ old('name')}}" placeholder="Enter task name">
            <small class="text-danger">{{ $errors->first('name') }}</small>
        </div>
        <div class="form-group">
            <label for="name">Project</label>
            <select name="project" class="form-control {{ $errors->has('project') ? 'is-invalid' : ''}}">
                <option value="">Select Project</option>
                @foreach ($projects as $project)
                    <option value="{{$project->id}}" {{ $project->id == old('project') ? 'selected' : '' }}>{{$project->name}}</option>
                @endforeach
            </select>
            <small class="text-danger">{{ $errors->first('project') }}</small>
        </div>
        <div class="form-group">
            <label for="priority">Priority</label>
            <input type="text" class="form-control {{ $errors->has('priority') ? 'is-invalid' : ''}}" id="priority" name="priority" value="{{ old('priority')}}" placeholder="Enter priority">
            <small class="text-danger">{{ $errors->first('priority') }}</small>
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
@endsection
