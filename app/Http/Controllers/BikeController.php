<?php

namespace App\Http\Controllers;

use App\Models\{Bike, BikeItems, BikeOption, Project};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Str;

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
        $check = json_decode($request->checkGoals, true);
        $estimate = json_decode($request->estimated_costs, true);
        $middle = json_decode($request->middle_costs, true);
        $actual = json_decode($request->actual_costs, true);

        $project_id = Project::select('id')->where(array('slug'=> $request->project_slug))->first();

        if ($request->hasFile('image')) {
            $file1 = $request->file('image')->getClientOriginalName();
            $filename1 = pathinfo($file1, PATHINFO_FILENAME);
            $extension1 = pathinfo($file1, PATHINFO_EXTENSION);
            $image = $filename1.'-'.time().'.'.$extension1;
            $image_path = $request->file('image')->move(public_path('storage/images'), $image);

            if (!empty($request->system_name) && !empty($image_path)){
                if(File::exists(storage_path('/app/public/images/').$request->system_name)){
                    File::delete(storage_path('/app/public/images/').$request->system_name);
                }
            }
        }else{
            $image = $request->system_name;
        }

        $request->validate([
            'name' => 'required|unique:bikes,name,'.$request->id,
        ]);

        $bike_data = Bike::updateOrCreate([
            'id'=> $request->id,
            ],[
            'project_id' => $project_id->id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'mobile' => $request->phone,
            'leader' => $request->leader,
            'assistant' => $request->assistant,
            'rating' => $request->rating,
            'estimated_cost' => $request->estimated_total,
            'actual_cost' => $request->actual_total,
            'image_name' => $image,
            'system_name' => $image,
        ]);

        if(!empty($bike_data) && !empty($bike_data->id)) {
            if(!empty($check) && count($check) > 0) {
                foreach ($check as $key => $row ) {
                    if ($row === true) {
                        BikeOption::updateOrCreate([
                            'goal_id' => $key,
                            'bike_id' => $bike_data->id,
                        ], [
                            'bike_id' => $bike_data->id,
                            'status' => 1,
                        ]);
                    } else {
                        BikeOption::updateOrCreate([
                            'goal_id' => $key,
                            'bike_id' => $bike_data->id,
                        ], [
                            'bike_id' => $bike_data->id,
                            'status' => 2,
                        ]);
                    }
                }
            }

            if (!empty($estimate) && count($estimate) > 0) {
                foreach ($estimate as $row) {
                    if(!empty($row['item_name']) && !empty($row['cost'])) {
                        $test = BikeItems::updateOrCreate([
                            'id' => $row['id'],
                            'bike_id' => $bike_data->id,
                        ], [
                            'stage_id' => 1,
                            'item_name' => $row['item_name'],
                            'cost' => $row['cost'],
                        ]);
                    }
                }
            }

            if (!empty($middle) && count($middle) > 0) {
                foreach ($middle as $row) {
                    if(!empty($row['item_name']) && !empty($row['cost'])) {
                        BikeItems::updateOrCreate([
                            'id' => $row['id'],
                            'bike_id' => $bike_data->id,
                        ], [
                            'stage_id' => 2,
                            'item_name' => $row['item_name'],
                            'cost' => $row['cost'],
                        ]);
                    }
                }
            }

            if (!empty($actual) && count($actual) > 0) {
                foreach ($actual as $row) {
                    if(!empty($row['item_name']) && !empty($row['cost'])) {
                        BikeItems::updateOrCreate([
                            'id' => $row['id'],
                            'bike_id' => $bike_data->id,
                        ], [
                            'stage_id' => 3,
                            'item_name' => $row['item_name'],
                            'cost' => $row['cost'],
                        ]);
                    }
                }
            }

            return response()->success();
        } else {
            return response()->error(false, 500);
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
        $data = Bike::select('id', 'name', 'slug', 'mobile', 'image_name')->where('project_id', $project_id->id)->get();
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
