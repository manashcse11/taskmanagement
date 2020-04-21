<?php

namespace App\Http\Controllers;

use App\Task;
use App\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $task = new Task();
        $data['tasks'] = $task->get_tasks($request->all());
        $data['projects'] = Project::orderby('name')->get();
        return view('task.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['projects'] = Project::orderby('name')->get();
        return view('task.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->task_validate($request);
        $task = new Task();
        if($this->task_insert_or_update($request, $task)){
            $request->session()->flash('status', 'Task added successfully!');
            return redirect()->route('tasks.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function task_validate($request, $id = ''){
        return $validated = $request->validate([
            'name' => 'required',
            'project' => 'required',
            'priority' => 'numeric'
        ]);
    }
    public function task_insert_or_update($request, $obj){
        $obj->name = $request->name;
        $obj->project_id = $request->project;
        $obj->priority = $request->priority;
        if($obj->save()){
            return true;
        }
        return false;
    }
}
