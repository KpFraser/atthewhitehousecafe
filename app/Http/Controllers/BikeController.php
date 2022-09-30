<?php

namespace App\Http\Controllers;

use App\Models\{Bike, BikeOption, Project};
use Illuminate\Http\Request;

class BikeController extends Controller
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
        if(!empty($request->bike && $request->check)){
            $project_id = Project::select('id')->where(array('slug'=> $request->bike['project_slug']))->first();
            $data = Bike::updateOrCreate([
                'id' => $request->bike['id']
            ],[
                'project_id' => $project_id->id,
                'name' => $request->bike['name'],
                'mobile' => $request->bike['phone'],
                'leader' => $request->bike['leader'],
                'assistant' => $request->bike['assistant'],
                'estimated_cost' => $request->bike['estimated_cost'],
                'actual_cost' => $request->bike['actual_cost'],
                'image_name' => $request->bike['image'],
                'system_name' => $request->bike['image'],
            ]);
//            dd($request->check);
            foreach ($request->check as $key => $row ) {
                if ($row === true) {
                    BikeOption::updateOrCreate([
                        'goal_id' => $key
                    ], [
                        'bike_id' => $data->id,
                        'status' => 1,
                    ]);
                } else{
                    BikeOption::updateOrCreate([
                        'goal_id' => $key
                    ], [
                        'bike_id' => $data->id,
                        'status' => 2,
                    ]);
                }
            }
            return response()->success($data);
        }else{
            return response()->error('data not found', 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bike  $bike
     * @return \Illuminate\Http\Response
     */
    public function show(Bike $bike)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bike  $bike
     * @return \Illuminate\Http\Response
     */
    public function edit(Bike $bike)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bike  $bike
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bike $bike)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bike  $bike
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bike $bike)
    {
        //
    }
}
