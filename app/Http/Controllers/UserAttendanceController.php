<?php

namespace App\Http\Controllers;

use App\Http\Resources\CafeResource;
use App\Models\CycleComment;
use App\Models\CycleTrackImage;
use App\Models\User;
use App\Models\UserAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;

class UserAttendanceController extends Controller
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

        $module = json_decode($request->module, true);
        $groupComment = json_decode($request->groupComment, true);
        $raw_date = json_decode($request->date, true);
        $s_time = json_decode($request->start_time, true);
        $e_time = json_decode($request->end_time, true);
        $date = Carbon::parse($raw_date)->format('Y.m.d');
        $start_time = Carbon::parse($s_time)->format('H:i:s');
        $end_time = Carbon::parse($e_time)->format('H:i:s');
        $length = json_decode($request->length, true);
        $previous_img = json_decode($request->previous_img, true);
//        dd($previous_img);

        $cycle_comment = CycleComment::updateOrCreate([
            'id' => $request->id,
        ],[
            'date' => $date,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'module' => $module,
            'comment' => $groupComment,
        ]);

        for ($i=1; $i <= $length; $i++ ){
            if ($request->hasFile('image'.$i)) {
                $file1 = $request->file('image'.$i)->getClientOriginalName();
                $filename1 = pathinfo($file1, PATHINFO_FILENAME);
                $extension1 = pathinfo($file1, PATHINFO_EXTENSION);
                $image = $filename1.'-'.time().'.'.$extension1;
                $request->file('image'.$i)->move(public_path('storage/images/cycle-track'), $image);

                CycleTrackImage::create([
                    'user_id'=> auth()->user()->id,
                    'image' => $image,
                    'system_name' => $filename1,
                    'cycle_comment_id' => $cycle_comment->id,
                ]);

                if (!empty($length) && $length !== 0 && count($previous_img) !== 0){
                    foreach ($previous_img as $item) {
                        if(!empty($item)){
                            if (File::exists(storage_path('/app/public/images/cycle-track/') . $item['image'])) {
                                File::delete(storage_path('/app/public/images/cycle-track/') . $item['image']);
                            }
                            CycleTrackImage::where('id', $item['id'])->delete();
                        }
                    }
                }
            }
        }

        $morning = json_decode($request->morning, true);
        $noon = json_decode($request->noon, true);
        $afternoon = json_decode($request->afternoon, true);

        $all_checks = [1=>$morning, 2=>$noon , 3=>$afternoon];

        foreach ($all_checks as $time_period => $check_row ) {
            if(!empty($check_row) && count($check_row) > 0) {
                foreach ($check_row as $key => $row ) {
                    if ($row) $status = 1;
                    else $status = 2;
                    UserAttendance::updateOrCreate([
                        'user_id' => $key,
                        'time_period' => $time_period,
                        'cycle_comment_id' =>$cycle_comment->id,
                    ], [
                        'status' => $status,
                    ]);
                }
            }
        }
        return response()->success();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserAttendance  $userAttendance
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($module)
    {
        if(!empty($module)){
            $data1 = User::select('id', 'name', 'created_by')->get();
            $data2 = CycleComment::select('id', 'date', 'comment', 'start_time', 'end_time')
                ->where('module', $module)
                ->with('UserAttendance', 'CycleTrackImage', 'UserComments')
                ->first();
            return response()->json(['data1'=> $data1, 'data2'=> new CafeResource($data2)]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserAttendance  $userAttendance
     * @return \Illuminate\Http\Response
     */
    public function edit(UserAttendance $userAttendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserAttendance  $userAttendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserAttendance $userAttendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserAttendance  $userAttendance
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $participant = User::where('id', $id)->first();
        if($participant->created_by === auth()->user()->id){
            $participant->delete();
            return response()->success();
        } else
            return response()->error('You have not created this participant', 500);
    }
}
