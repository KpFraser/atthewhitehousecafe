<?php

namespace App\Http\Controllers;

use App\Models\ProjectUser;
use App\Models\ProjectUserImages;
use App\Models\User;
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
            $user_id = json_decode($request->id, true);
            $project_id = json_decode($request->project_id, true);
            $length = json_decode($request->length, true);
            $comment = json_decode($request->comment, true);
            $name = json_decode($request->userName, true);
            $previous_img = json_decode($request->previous_img, true);
//        dd($previous_img[0]['image']);

        for ($i=1; $i <= $length; $i++ ){
            if ($request->hasFile('image'.$i)) {
                $file1 = $request->file('image'.$i)->getClientOriginalName();
                $filename1 = pathinfo($file1, PATHINFO_FILENAME);
                $extension1 = pathinfo($file1, PATHINFO_EXTENSION);
                $image = $filename1.'-'.time().'.'.$extension1;
                $request->file('image'.$i)->move(public_path('storage/images/roster'), $image);

                User::where('id', $user_id)->update(array('name'=> $name));

                $data = ProjectUser::updateOrCreate([
                    'user_id'=> $user_id,
                    'project_id' => $project_id,
                ],[
                    'comment'=> $comment,
                ]);

                ProjectUserImages::updateOrCreate([
                    'id'=> null,
                ],[
                    'project_user_id'=>$data->id,
                    'user_id'=> $user_id,
                    'project_id' => $project_id,
                    'image_name' => $image,
                    'system_name' => $filename1,
                ]);

                if (!empty($length) && $length !== 0 && count($previous_img) !== 0){
                    foreach ($previous_img as $item) {
                        if(!empty($item)){
                            if (File::exists(storage_path('/app/public/images/roster/') . $item['image'])) {
                                File::delete(storage_path('/app/public/images/roster/') . $item['image']);
                            }
                            ProjectUserImages::where('id', $item['PUI_identity'])->delete();
                        }
                    }
                }
            }
        }

//        if ($request->hasFile('image')) {
//            $file1 = $request->file('image')->getClientOriginalName();
//            $filename1 = pathinfo($file1, PATHINFO_FILENAME);
//            $extension1 = pathinfo($file1, PATHINFO_EXTENSION);
//            $image = $filename1.'-'.time().'.'.$extension1;
//            $image_path = $request->file('image')->move(storage_path('/app/public/images/roster'), $image);
//
//            if (!empty($request->system_name)){
//                if(File::exists(storage_path('/app/public/images/').$request->system_name)){
//                    File::delete(storage_path('/app/public/images/').$request->system_name);
//                }
//            }
//        } else {
//            $image = $request->system_name;
//            $filename1 = $request->system_name;
//        }

//        User::where('id', $request->id)->update(array('name'=> $request->userName));
//        $data = ProjectUser::updateOrCreate([
//            'user_id'=> $request->id,
//            'project_id' => $request->project_id,
//        ],[
//            'comment'=> $request->comment,
//            'roster_image' => $filename1,
//            'system_name' => $image,
//        ]);
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
        ProjectUser::updateOrCreate([
            'user_id'=> auth()->user()->id,
            'project_id' => $request->id,
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
