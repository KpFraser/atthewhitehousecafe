<?php

namespace App\Http\Controllers;

use App\Models\LeadershipTeam;
use Illuminate\Http\Request;

class LeadershipTeamController extends Controller
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
        if(!empty($request->checkedOptions) && count($request->checkedOptions) > 0) {
            foreach ($request->checkedOptions as $key => $row ) {
                if ($row) $status = 1;
                else $status = 2;
                    LeadershipTeam::updateOrCreate([
                        'user_id' => $key,
                        'project_id' => $request->project_id,
                        'role' => $request->role,
                    ], [
                        'apply_appoint' => $request->apply_appoint,
                        'status' => $status,
                    ]);
            }
            return response()->success();
        } else
            return response()->error('something went wrong', 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LeadershipTeam  $leadershipTeam
     * @return \Illuminate\Http\Response
     */
    public function show(LeadershipTeam $leadershipTeam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LeadershipTeam  $leadershipTeam
     * @return \Illuminate\Http\Response
     */
    public function edit(LeadershipTeam $leadershipTeam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LeadershipTeam  $leadershipTeam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LeadershipTeam $leadershipTeam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LeadershipTeam  $leadershipTeam
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeadershipTeam $leadershipTeam)
    {
        //
    }
}
