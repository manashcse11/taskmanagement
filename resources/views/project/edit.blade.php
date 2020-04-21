@extends('layouts.app')

@section('title', 'Project Edit')

@section('content')
    <h3>Edit Project</h3>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <form method="POST" action="{{ route('projects.update', $project->id) }}">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" id="name" name="name" value="{{ old('name', $project->name)}}" placeholder="Enter project name">
            <small class="text-danger">{{ $errors->first('name') }}</small>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
