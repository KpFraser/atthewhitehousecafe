<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use function GuzzleHttp\Promise\all;

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
//        $groupComment = json_decode($request->groupComment, true);
//        $date = json_decode($request->date, true);
//        $date = Carbon::parse($date)->format('Y.m.d');

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
    public function show()
    {
        $data1 = User::select('id', 'name')->get();
        $data2 = UserAttendance::all();
        return response()->json(['data1'=> $data1, 'data2'=> $data2]);
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
    public function destroy(UserAttendance $userAttendance)
    {
        //
    }
}
