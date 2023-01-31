<?php

namespace App\Http\Controllers;

use App\Models\RiskManagement;
use Illuminate\Http\Request;

class RiskManagementController extends Controller
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
//        dd($request->project_id);
        foreach ($request->riskManagement as $data){
            RiskManagement::updateOrCreate([
                'project_id'=> $request->project_id,
                'user_id'=> auth()->user()->id,
                'id'=> $data['id'],
            ],[
                'user_id'=> auth()->user()->id,
                'name'=>$data['name'],
                'risk'=>$data['risk'],
                'control'=>$data['control'],
            ]);
        }
        return response()->success();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RiskManagement  $riskManagement
     * @return \Illuminate\Http\Response
     */
    public function show(RiskManagement $riskManagement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RiskManagement  $riskManagement
     * @return \Illuminate\Http\Response
     */
    public function edit(RiskManagement $riskManagement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RiskManagement  $riskManagement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiskManagement $riskManagement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiskManagement  $riskManagement
     * @return \Illuminate\Http\Response
     */
    public function destroy(RiskManagement $riskManagement)
    {
        //
    }
}
