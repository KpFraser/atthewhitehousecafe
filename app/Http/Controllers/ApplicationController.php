<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Project;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Reference;

class ApplicationController extends Controller
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
        if(!empty($data)) {
            $status = [url('project/reference/'.$data->email.'/'.$data->project_id.'/'.$data->role_id.'/'.$data->id)];
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

        return response([$data1, $data2]);
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
}
