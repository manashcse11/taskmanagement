@extends('layouts.app')

@section('title', 'Task List')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <h3>Tasks <a href="{{ route('tasks.create') }}"><span class="badge badge-success">New</span></a></h3>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <form method="GET" action="{{ route('home') }}">
        @csrf
        <div class="row">
            <div class="form-group col-sm-4">
                <label for="name">Project</label>
                <select id="project_id" name="project_id" class="form-control">
                    <option value="">All Project</option>
                    @foreach ($projects as $project)
                        <option value="{{$project->id}}" {{ $project->id == request('project_id') ? 'selected' : '' }}>{{$project->name}}</option>
                    @endforeach
                </select>
                <small class="text-danger">{{ $errors->first('project') }}</small>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
    @if (count($tasks) > 0)
        <div id="task-sortable" class="row">
            @foreach ($tasks as $task)
                <div id="{{ $task->id }}" class="col-sm-12 mt-3" style="cursor: move;">
                    <div class="card">
                        <div class="card-body p-3">
                            {{ $task->name }}
                            <div class="text-right">
                                <span class="badge badge-pill badge-info">{{ $task->project->name }}</span>
                                <a href="{{ route('tasks.edit', $task->id) }}"><span class="badge badge-pill badge-warning">Edit</span></a>
                                <a href="{{ route('tasks.delete', $task->id) }}"><span class="badge badge-pill badge-danger">Delete</span></a>
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

    <script>
        $( function() {
            // $( "#task-sortable" ).sortable();
            $( "#task-sortable" ).sortable({
                'containment': 'parent',
                'revert': true,
                update: function(event, ui) {
                    $.ajax({
                        url: "{{ route('tasks.reorder') }}",
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {sorted_task: $("#task-sortable").sortable('toArray')},
                        success: function(data) {
                            if(data.success) {
                                $('<div class="alert alert-success" role="alert">Task priority has been changed.</div>').insertBefore('#task-sortable').delay(1000).fadeOut(function(){
                                    $(this).remove();
                                });
                            }
                        }
                    });
                }
            });
            $( "#task-sortable" ).disableSelection();
        } );
    </script>
@endsection
