<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Project;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Reference;
use Illuminate\Support\Str;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function application()
    {
        $data = Application::select('id', 'project_id', 'name', 'role_id', 'text1', 'text2', 'text3', 'ref1_email', 'ref2_email')
            ->with('ProjectsName', 'ApplicationRoles', 'ApplicantReference')->get();
        return response()->success($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = Application::Create([
            'project_id' => $request->project_id,
            'role_id'=> $request->role_id,
            'name'=> $request->name,
            'created_by'=> !empty(auth()->user()->id) ? auth()->user()->id: NULL,
            'email'=> $request->email,
            'ref1_email'=> $request->ref_one,
            'ref2_email'=> $request->ref_two,
            'text1'=> $request->first_txt,
            'text2'=> $request->second_txt,
            'text3'=> $request->third_txt,
        ]);
        if(!empty($request->project_id))
            $project=Project::select('id','slug', 'name')->where('id', $request->project_id)->first();

        if(!empty($request->role_id))
            $role=Role::select('id','name')->where('id', $request->role_id)->first();

        if(!empty($data) && !empty($project->slug) && !empty($role->name)) {
            $status = [
                'url'=>url('project/reference/'.$data->email.'/'.$project->slug.'/'.$this->SlugCreate($role->name).'/'.$this->SlugCreate($data->name)),
                'name'=> $data->name,
                'email'=> $data->email,
                'role' => $role->name,
                'project'=> $project->name,
            ];
            Mail::to($data->ref1_email)->send(new Reference($status));
            if(!empty($data->ref2_email)) {
                Mail::to($data->ref2_email)->send(new Reference($status));
            }
            return response()->success();
        } else
            return response()->error(false, 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data1 = Project::select('id', 'name')->where('is_approved', 1)->get();
        $data2 = Role::select('id', 'name')->get();

        return response()->success([$data1, $data2]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Application $application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        //
    }

    public function SlugCreate($title){
        return Str::slug($title);
    }

    public function answers($id, $project_slug)
    {
        $project_id = Project::select('id')->where('slug', $project_slug)->first();

        if (!empty($id) && $id !== 0){

            $data = Application::select('id', 'name', 'text1', 'text2', 'text3', 'ref1_email', 'ref2_email')
            ->where(array('role_id'=> $id, 'project_id'=> $project_id->id))->get();
            if (!empty($data)){
                return response()->success($data);
            } else {
                return response()->error('Not found', 220);
            }
        }
        else {
            $data = Application::select('id', 'name', 'text1', 'text2', 'text3', 'ref1_email', 'ref2_email')
                ->where(array('project_id'=> $project_id->id))->get();
            if (!empty($data)){
                return response()->success($data);
            } else {
                return response()->error('Not found', 220);
            }
        }
    }
}
