<?php

namespace App\Http\Controllers;

use App\Models\ProjectUser;
use Illuminate\Http\Request;

class ProjectUserController extends Controller
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
    public function addComment(Request $request)
    {
        ProjectUser::updateOrCreate([
            'project_id' => $request->project_id,
        ],[
            'comment'=> $request->comment,
        ]);
        return response()->success();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectUser  $projectUser
     * @return \Illuminate\Http\Response
     */
    public function isRoster(Request $request)
    {
        $data = $request->check;
        if ( $data == true ){
            ProjectUser::updateOrCreate([
                'user_id' => $request->user_id,
            ],[
                'is_roster'=> 1,
            ]);
        }else {
            ProjectUser::updateOrCreate([
                'user_id' => $request->user_id,
            ],[
                'is_roster'=> 0,
            ]);
        }
        return response()->success();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectUser  $projectUser
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectUser $projectUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectUser  $projectUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
//        dd($request->all());
        ProjectUser::updateOrCreate([
            'project_id' => $request->id,
            'user_id'=> auth()->user()->id,
        ],[
            'user_id'=> auth()->user()->id,
            'is_user'=> 1,
        ]);
        return response()->success();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectUser  $projectUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectUser $projectUser)
    {
        //
    }
}
