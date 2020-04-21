@extends('layouts.app')

@section('title', 'Task Edit')

@section('content')
    <h3>Edit Task</h3>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <form method="POST" action="{{ route('tasks.update', $task->id) }}">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" id="name" name="name" value="{{ old('name', $task->name)}}" placeholder="Enter project name">
            <small class="text-danger">{{ $errors->first('name') }}</small>
        </div>
        <div class="form-group">
            <label for="name">Project</label>
            <select name="project" class="form-control {{ $errors->has('project') ? 'is-invalid' : ''}}">
                <option value="">Select Project</option>
                @foreach ($projects as $project)
                    <option value="{{$project->id}}" {{ $project->id == old('project', $task->project_id) ? 'selected' : '' }}>{{$project->name}}</option>
                @endforeach
            </select>
            <small class="text-danger">{{ $errors->first('project') }}</small>
        </div>
        <div class="form-group">
            <label for="priority">Priority</label>
            <input type="text" class="form-control {{ $errors->has('priority') ? 'is-invalid' : ''}}" id="priority" name="priority" value="{{ old('priority', $task->priority)}}" placeholder="Enter priority">
            <small class="text-danger">{{ $errors->first('priority') }}</small>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
