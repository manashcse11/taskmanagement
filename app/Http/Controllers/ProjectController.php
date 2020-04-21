<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = new Project();
        $data['projects'] = $project->orderby('name')->get();
        return view('project.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->project_validate($request);
        $project = new Project();
        if($this->project_insert_or_update($request, $project)){
            $request->session()->flash('status', 'Project added successfully!');
            return redirect()->route('projects.index');
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
        $data['project'] = Project::find($id);
        return view('project.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $this->project_validate($request, $project->id);
        if($this->project_insert_or_update($request, $project)){
            $request->session()->flash('status', 'Project saved successfully!');
            return redirect()->route('projects.index');
        }
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
    /**
     * Non conventional Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, Project $project)
    {
        if($project->delete()){
            $request->session()->flash('status', 'Project has been deleted!');
            return redirect()->route('projects.index');
        }
    }

    public function tasks($project_id)
    {
        $project = new Project();
        $data['tasks'] = $project->get_tasks($project_id);
        return view('task.list', $data);
    }

    public function project_validate($request, $id = ''){
        return $validated = $request->validate([
            'name' => 'required|unique:projects,name,' . $id
        ]);
    }
    public function project_insert_or_update($request, $obj){
        $obj->name = $request->name;
        if($obj->save()){
            return true;
        }
        return false;
    }
}
