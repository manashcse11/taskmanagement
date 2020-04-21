@extends('layouts.app')

@section('title', 'Project Create')

@section('content')
    <h3>Create Project</h3>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <form method="POST" action="{{ route('projects.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" id="name" name="name" value="{{ old('name')}}" placeholder="Enter project name">
            <small class="text-danger">{{ $errors->first('name') }}</small>
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
@endsection
