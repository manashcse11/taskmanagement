@extends('layouts.app')

@section('title', 'Project List')

@section('content')
    <h3>Projects <a href="{{ route('projects.create') }}"><span class="badge badge-success">New</span></a></h3>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    @if (count($projects) > 0)
        <div class="row">
        @foreach ($projects as $project)
            <div class="col-sm-4 mt-5">
                <div class="card">
                    <div class="card-body">
                        {{ $project->name }}
                        <div class="text-right">
                            <a href="{{ route('tasks_by_project', $project->id) }}"><span class="badge badge-pill badge-info">View tasks</span></a>
                            <a href="{{ route('projects.edit', $project->id) }}"><span class="badge badge-pill badge-warning">Edit</span></a>
                            <a href="{{ route('projects.delete', $project->id) }}"><span class="badge badge-pill badge-danger">Delete</span></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    @else
        <div class="mt-5 col-md-12 text-center alert-light">
            No data available
        </div>
    @endif

@endsection
