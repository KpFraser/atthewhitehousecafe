<?php

namespace App\Http\Controllers;

use App\Models\Funding;
use Illuminate\Http\Request;

class FundingController extends Controller
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
//        dd($request->all());
        Funding::updateOrCreate([
            'user_id'=> auth()->user()->id,
            'project_id'=> $request->project_id,
        ],[
            'funding' => $request->finance['funding'],
            'text1' => $request->finance['text1'],
            'text2' => $request->finance['text2'],
        ]);
        return response()->success();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Funding  $funding
     * @return \Illuminate\Http\Response
     */
    public function show(Funding $funding)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Funding  $funding
     * @return \Illuminate\Http\Response
     */
    public function edit(Funding $funding)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Funding  $funding
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Funding $funding)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Funding  $funding
     * @return \Illuminate\Http\Response
     */
    public function destroy(Funding $funding)
    {
        //
    }
}
