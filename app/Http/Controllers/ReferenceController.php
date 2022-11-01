<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Project;
use App\Models\Reference;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if(!empty($request->info['project_slug']) && !empty($request->info['role']) && !empty($request->info['app_slug'])){
            $project_slug = $request->info['project_slug'];
            $role = $this->StringConverter($request->info['role']);
            $app_slug = $this->StringConverter($request->info['app_slug']);
             if(!empty($project_slug) && !empty($role) && !empty($app_slug)){
                 if(!empty($project_slug))
                     $project=Project::select('id','slug')->where('slug', $project_slug)->first();

                 if(!empty($role))
                     $role=Role::select('id','name')->where('name', $role)->first();

                 if(!empty($app_slug))
                     $application=Application::select('id','name')->where('name', $app_slug)->first();

                 Reference::Create([
                     'project_id' => $project->id,
                     'role_id'=> $role->id,
                     'reference_email'=> $request->info['email'],
                     'application_id'=> $application->id,
                     'payload'=> json_encode($request->form,)
                 ]);
                 return response()->success();
             }

        }
        return response()->error();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reference  $reference
     * @return \Illuminate\Http\Response
     */
    public function show(Reference $reference)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reference  $reference
     * @return \Illuminate\Http\Response
     */
    public function edit(Reference $reference)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reference  $reference
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reference $reference)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reference  $reference
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reference $reference)
    {
        //
    }

    public function StringConverter($slug)
    {
        return Str::title(str_replace('-', ' ', $slug));
    }
}
