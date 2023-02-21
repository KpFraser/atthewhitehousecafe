<?php

namespace App\Http\Controllers;

use App\Models\SocialMedia;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
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
        if(!empty($request->social && $request->project_id)) {
            SocialMedia::updateOrCreate([
                'project_id' => $request->project_id,
                'user_id' => auth()->user()->id,
            ], [
                'facebook' => !empty($request->social['facebook']) ? $request->social['facebook']:'',
                'twitter' => !empty($request->social['twitter']) ? $request->social['twitter']:'',
                'instagram' => !empty($request->social['instagram']) ? $request->social['instagram']:'',
                'youtube' => !empty($request->social['youtube']) ? $request->social['youtube']:'',
                'website' => !empty($request->social['website']) ? $request->social['website']:'',
                'meetup' => !empty($request->social['meetup']) ? $request->social['meetup']:'',
                'others' => !empty($request->social['others']) ? $request->social['others']:'',
            ]);
            return response()->success();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SocialMedia  $socialMedia
     * @return \Illuminate\Http\Response
     */
    public function show(SocialMedia $socialMedia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SocialMedia  $socialMedia
     * @return \Illuminate\Http\Response
     */
    public function edit(SocialMedia $socialMedia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SocialMedia  $socialMedia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SocialMedia $socialMedia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SocialMedia  $socialMedia
     * @return \Illuminate\Http\Response
     */
    public function destroy(SocialMedia $socialMedia)
    {
        //
    }
}
