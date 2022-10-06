<?php

namespace App\Http\Controllers;

use App\Models\{Bike, BikeItems, BikeOption, Project};
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
        dd($request->all());
        if(!empty($request->bike && $request->check && $request->estimate && $request->actual)){
            $project_id = Project::select('id')->where(array('slug'=> $request->bike['project_slug']))->first();

//            if($request->hasFile('image'))
//            {
//                $file1 = $request->file('image')->getClientOriginalName();
//                $filename1 = pathinfo($file1, PATHINFO_FILENAME);
//                $extension1 = pathinfo($file1, PATHINFO_EXTENSION);
//                $image = $filename1.'-'.time().'.'.$extension1;
//                $request->file('image')->move(public_path('images'), $image);
//            }else{
//                $image = $request->image;
//            }

            $bike_data = Bike::Create([
                'project_id' => $project_id->id,
                'name' => $request->bike['name'],
                'mobile' => $request->bike['phone'],
                'leader' => $request->bike['leader'],
                'assistant' => $request->bike['assistant'],
                'estimated_cost' => $request->bike['estimated_cost'],
                'actual_cost' => $request->bike['actual_cost'],
                'image_name' => $image,
                'system_name' => $request->bike['image'],
            ]);
            foreach ($request->check as $key => $row ) {
                if ($row === true) {
                    BikeOption::updateOrCreate([
                        'goal_id' => $key
                    ], [
                        'bike_id' => $bike_data->id,
                        'status' => 1,
                    ]);
                } else{
                    BikeOption::updateOrCreate([
                        'goal_id' => $key
                    ], [
                        'bike_id' => $bike_data->id,
                        'status' => 2,
                    ]);
                }
            }
            foreach ($request->estimate as $row) {
                BikeItems::updateOrCreate([
                    'bike_id' => $bike_data->id,
                ], [
                    'stage_id' => 1,
                    'item_name' => $row['item'],
                    'cost' => $row['cost'],
                ]);
            }
            foreach ($request->actual as $row) {
                BikeItems::updateOrCreate([
                    'bike_id' => $bike_data->id,
                ], [
                    'stage_id' => 2,
                    'item_name' => $row['item'],
                    'cost' => $row['cost'],
                ]);
            }
            return response()->success();
        }else{
            return response()->error('Data not saved!', 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bike  $bike
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $project_id = Project::select('id')->where('slug', $slug)->first();
        $data = Bike::select('id', 'name', 'mobile')->where('project_id', $project_id->id)->get();
        return response()->success($data);
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
