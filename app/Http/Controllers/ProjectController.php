<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectUser;
use Illuminate\Http\Request;
use App\Http\Resources\ProjectResource;
use Inertia\Inertia;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Project::select('id', 'name')->get();
        return response($data);
    }

    public function footer_project()
    {
        $favourite = Project::select()->where('is_key', 1)->get();
       if (!empty($favourite[0])){
           return Inertia::render('project/project');
       }
       else
       {
           return Inertia::render('ProjectsHome');
       }
    }

    public function favourite_info()
    {
        $data = Project::select('id', 'name', 'frequency', 'is_key')->where('is_key', 1)->get();
        if (!empty($data)) {
            return response($data);
        }
    }
    public function favourite()
    {
        $data = Project::select('id', 'is_key')->where('is_key', 1)->get();
        if (!empty($data)) {
            return response($data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function approve(Request $request)
    {
        Project::updateOrCreate([
            'id' => $request->identity,
        ],[
            'name'=> $request->name,
            'location'=> $request->location,
            'frequency'=> $request->frequency,
            'requirements'=> $request->requirements,
            'leadership'=> $request->leadership,
            'is_approved'=> $request->approve,
        ]);
        return response()->success();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
        {
            Project::updateOrCreate([
                'id' => $request->name['id'],
            ],[
                'created_by'=> auth()->user()->id,
                'name'=> $request->name['name'],
                'module'=> $request->module,
            ]);
            return response()->success();
        }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return ProjectResource
     */

    public function show (Project $id)
    {
            return new ProjectResource($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function isarchieve(Request $request)
    {
        Project::updateOrCreate([
            'id' => $request->id,
        ],[
            'is_archived'=> 1,
            'is_key'=> 0,
        ]);
        return response()->success();
    }

    public function unarchieve(Request $request)
    {
        Project::updateOrCreate([
            'id' => $request->id,
        ],[
            'is_archived'=> 0,
        ]);
        return response()->success();
    }

    public function iskey(Request $request)
    {
        Project::where('module', 1)->update(array('is_key' => '0'));

        Project::updateOrCreate([
            'id' => $request->id,
        ],[
            'is_key'=> 1,
        ]);
        return response()->success();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        Project::updateOrCreate([
            'id' => $request->identity,
        ],[
            'name'=> $request->name,
            'location'=> $request->location,
            'frequency'=> $request->frequency,
            'requirements'=> $request->requirements,
            'leadership'=> $request->leadership,
        ]);
        return response()->success();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function projects(Project $project)
    {
//        $health = Project::with('user_project')->all();

        $data = Project::select('id','name', 'is_approved', 'is_archived', 'is_key')->with('projectUser')->where('module', 1 )->get();

        return response($data);
    }
    public function destroy($id)
    {
        Project::where('id', $id)->delete();
        return response()->success();
    }
}
