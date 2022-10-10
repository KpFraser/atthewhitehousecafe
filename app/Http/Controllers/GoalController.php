<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use App\Models\BikeItems;
use App\Models\BikeOption;
use App\Models\Goal;
use Illuminate\Http\Request;

class GoalController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($slug)
    {
        if ($slug !== 'undefined'){
            $bike = Bike::select('id', 'name', 'mobile', 'slug', 'leader', 'assistant', 'system_name', 'image_name', 'estimated_cost', 'actual_cost')->first();
            $bike_items = BikeItems::select('id', 'bike_id', 'stage_id', 'item_name', 'cost')->where('bike_id', $bike->id)->get();
            $bike_option = BikeOption::select('id', 'bike_id', 'goal_id', 'status')->where('bike_id', $bike->id)->get();
            $goal = Goal::select('id', 'name')->get();
            return response()->json(array('bike' => $bike, 'bike_items' => $bike_items, 'bike_option' => $bike_option, 'goal' => $goal));
        } else {
            $goal = Goal::select('id', 'name')->get();
            return response()->json(array('goal' => $goal));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function edit(Goal $goal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Goal $goal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Goal $goal)
    {
        //
    }
}
