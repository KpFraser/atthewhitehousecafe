<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Project;
use App\Models\ProjectUser;
use Illuminate\Http\Request;
use App\Http\Resources\{ ProjectResource, AllProjectResource };
use Inertia\Inertia;
use Str;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Project::select('id', 'name', 'slug')->where('is_approved', '!=', 1)->orWhereNull('is_approved')->orderBy('name')->get();
        return response($data);
    }

    public function footer_project()
    {
       $favourite = ProjectUser::select('id', 'user_id')->where(array('is_key'=> 1, 'user_id'=> auth()->user()->id))->first();

       if (!empty($favourite)){
           return Inertia::render('project/project');
       }
       else
       {
           return Inertia::render('ProjectsHome');
       }
    }

    public function favourite_info()
    {
        $data1 = ProjectUser::select('id', 'project_id')->where(array('is_key'=> 1, 'user_id'=> auth()->user()->id))->with('key_project')->first();
        $data2 = Event::select('id', 'name', 'slug')->get();
        return response([$data1, $data2]);
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
            'id' => $request->id,
        ],[
            'name'=> $request->name,
            'location'=> $request->location,
            'frequency'=> $request->frequency,
            'requirements'=> $request->requirements,
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
           $request->validate([
                'name' => 'required|unique:projects,name,'.$request->name['id'],
           ]);
            Project::updateOrCreate([
                'id' => $request->name['id'],
            ],[
                'slug' => Str::slug($request->name['name']),
                'created_by'=> auth()->user()->id,
                'name'=> $request->name['name'],
                //'module'=> $request->module,
            ]);
            return response()->success();
        }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return ProjectResource
     */

    public function show ($slug)
    {
        $data = Project::select('id', 'name', 'slug', 'location', 'frequency', 'requirements', 'is_approved')->where('slug', $slug)->first();
        return response()->success($data);
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
        ProjectUser::where('user_id', auth()->user()->id )->update(array('is_key' => '0'));

        ProjectUser::updateOrCreate([
            'project_id' => $request->id,
            'user_id'=> auth()->user()->id,
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
//        dd($request->all());
        Project::updateOrCreate([
            'id' => $request->id,
        ],[
            'slug' => Str::slug($request->name),
            'name'=> $request->name,
            'location'=> $request->location,
            'frequency'=> $request->frequency,
            'requirements'=> $request->requirements,
        ]);
        return response()->success();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return AllProjectResource
     */
    public function projects(Project $project)
    {
        $data = Project::select( 'id', 'name', 'is_approved', 'is_archived', 'slug' )->with('projectUser')->get();

        return AllProjectResource::Collection($data);
    }

    public function destroy($id)
    {
        Project::where('id', $id)->delete();
        return response()->success();
    }
}
