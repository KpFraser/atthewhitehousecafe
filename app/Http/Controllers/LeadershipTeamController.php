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
        LeadershipTeam::updateOrCreate([
            'user_id'=> auth()->user()->id,
        ],[
            'assistants' => $request->assistances,
            'organisers' => $request->organisers,
            'leaders' => $request->leaders,
            'mentors' => $request->mentors,
        ]);
        return response()->success();
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
