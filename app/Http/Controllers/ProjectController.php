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
        return response()->success($data);
    }

    public function footer_project()
    {
         return Inertia::render('ProjectsHome');

//       $favourite = ProjectUser::select('id', 'user_id')->where(array('is_key'=> 1, 'user_id'=> auth()->user()->id))->first();
//
//       if (!empty($favourite))
//           return Inertia::render('project/project');
//       else
//           return Inertia::render('ProjectsHome');
    }

    public function events ($id)
    {
        $data = Event::select('id', 'name', 'slug')->where('project_id', $id)->get();
        if (!empty($data))
            return response()->success($data);
    }

    public function names ()
    {
        $data = Project::select('name', 'slug')->where(array('is_approved'=> 1))->orderBy('name')->get();
        return response()->success($data);
    }
    public function editFavouriteInfo($slug)
    {
        if(!empty($slug)){
            $project_id = Project::select('id')->where('slug', $slug)->first();
            $data1 = ProjectUser::select('id', 'project_id')->where(array('project_id'=> $project_id->id, 'user_id'=> auth()->user()->id))->with('key_project')->first();
            $data2 = Event::select('id', 'name', 'slug')->where('project_id', $project_id->id)->get();
            return response()->success([$data1, $data2]);
        } else
            return response()->error('Data not available!', 500);
    }

    public function favouriteInfo()
    {
        $data1 = ProjectUser::select('id', 'project_id')->where(array('is_key'=> 1, 'user_id'=> auth()->user()->id))->with('key_project')->first();
        $data2 = Event::select('id', 'name', 'slug')->where(array('project_id'=> $data1->project_id))->get();
        return response()->success([$data1, $data2]);
    }

    public function showArchieve()
    {
        $data = Project::select('id', 'name')->where(array('is_archived' => 1, 'is_approved' => 1))->get();
        if (!empty($data))
            return response()->success($data);
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
                'name' => 'required|unique:projects,name,'.$request->id,
           ]);
            Project::updateOrCreate([
                'id' => $request->id,
            ],[
                'slug' => Str::slug($request->name),
                'created_by'=> auth()->user()->id,
                'name'=> $request->name,
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
//        dd($request->all());
        ProjectUser::where('user_id', auth()->user()->id )->update(array('is_key' => 0));

        $data =ProjectUser::updateOrCreate([
            'project_id' => $request->id,
            'user_id'=> auth()->user()->id,
        ],[
            'is_key'=> $request->key,
        ]);
        return response()->success($data->is_key);
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
        $request->validate([
            'name' => 'required|unique:projects,name,'.$request->id,
        ]);
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
        $data = Project::select( 'id', 'name', 'is_approved', 'is_archived', 'slug' )
            ->with('projectUser')->orderBy('name')->get();
        return response()->success(AllProjectResource::Collection($data));
    }

    public function destroy($id)
    {
        Project::where('id', $id)->delete();
        return response()->success();
    }

    public function deleteUser($id)
    {
        dd($id);
//        Project::where('id', $id)->delete();
//        return response()->success();
    }
}
