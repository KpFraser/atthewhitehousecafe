<?php

namespace App\Http\Controllers;

use App\Models\Funding;
use App\Models\LeadershipTeam;
use App\Models\Location;
use App\Models\RiskManagement;
use App\Models\Safety;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class LocationController extends Controller
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
//        dd($request->location['id']);
        $data = Location::updateOrCreate([
            'id' => $request->location['id'],
            'user_id' => auth()->user()->id,
            ],[
            'name' => $request->location['name'],
            'city' => $request->location['city'],
            'postcode' => $request->location['postcode'],
            'address_1' => $request->location['address_1'],
            'address_2' => $request->location['address_2'],
            'country' => $request->location['country'],
            "repeat_on" => json_encode($request->day),
            "repeat_time" => $request->location['repeat_time'],
            "repeat_every" => $request->location['repeat_every'],
            "never" => $request->location['never'],
            "on" => $request->location['on'],
            "after" => $request->location['after'],
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
        ]);
        return response()->success();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Location $location)
    {
        $data1 = Location::select('id', 'name',	'address_1', 'address_2', 'city', 'postcode', 'country', 'repeat_time', 'repeat_every',	'repeat_on', 'never', 'on', 'after')->where('user_id', auth()->user()->id)->first();
        if(!empty($data1))
            $data2 = json_decode($data1->repeat_on);
        else
            $data2 = null;
        $data3 = RiskManagement::select('id', 'name', 'risk', 'control')->where('user_id', auth()->user()->id)->get();
        $data4 = Safety::select('id', 'document', 'date', 'text1', 'text2', 'text3')->where('user_id', auth()->user()->id)->first();
        $data5 = Funding::select('id', 'funding', 'text1', 'text2')->where('user_id', auth()->user()->id)->first();
        $data6 = SocialMedia::select('facebook', 'twitter', 'instagram', 'website', 'meetup', 'others', 'youtube')->where('user_id', auth()->user()->id)->first();
        $data7 = LeadershipTeam::select('organisers', 'leaders', 'assistants', 'mentors')->where('user_id', auth()->user()->id)->first();

        return response()->json([$data1, $data2, $data3, $data4, $data5, $data6, $data7]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        //
    }
}
