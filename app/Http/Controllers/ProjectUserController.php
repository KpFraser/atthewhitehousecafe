<?php

namespace App\Http\Controllers;

use App\Models\ProjectUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
//        dd($request->project_id);
        ProjectUser::select('id', 'user_id', 'is_roster')
            ->where(array('user_id'=> $request->id, 'project_id' => $request->project_id))
            ->update(array('is_roster'=> !empty($request->check)? 1 : 0));

        return response()->success();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectUser  $projectUser
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if ($request->hasFile('image')) {
            $file1 = $request->file('image')->getClientOriginalName();
            $filename1 = pathinfo($file1, PATHINFO_FILENAME);
            $extension1 = pathinfo($file1, PATHINFO_EXTENSION);
            $image = $filename1.'-'.time().'.'.$extension1;
            $image_path = $request->file('image')->move(storage_path('/app/public/images/roster'), $image);

            if (!empty($request->system_name)){
                if(File::exists(storage_path('/app/public/images/').$request->system_name)){
                    File::delete(storage_path('/app/public/images/').$request->system_name);
                }
            }
        } else {
            $image = $request->system_name;
            $filename1 = $request->system_name;
        }

        $data = ProjectUser::updateOrCreate([
            'user_id'=> $request->id,
            'project_id' => $request->project_id,
        ],[
            'comment'=> $request->comment,
            'roster_image' => $filename1,
            'system_name' => $image,
        ]);
        return response()->success();
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
