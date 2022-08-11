<?php

namespace App\Http\Controllers;

use App\Models\{UHealthcare, User};
use Illuminate\Http\Request;

class UHealthcareController extends Controller
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
     * @param  \App\Models\UHealthcare  $uHealthcare
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $health = User::with('UHealthcares')->first();
        if (!empty($health->UHealthcares)){
            return response($health->UHealthcares);
        }else
        {
            return response()->error('Data Missing', 204);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UHealthcare  $uHealthcare
     * @return \Illuminate\Http\Response
     */
    public function edit(UHealthcare $uHealthcare)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UHealthcare  $uHealthcare
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $user_id = Auth()->user()->id;
        UHealthcare::updateOrCreate([
            'user_id'=> $user_id,
        ],[
            'emergency_name'=> $request->emergency_name,
            'emergency_contact'=> $request->emergency_contact,
            'dr_name'=> $request->dr_name,
            'dr_contact'=> $request->dr_contact,
        ]);
        return response()->success();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UHealthcare  $uHealthcare
     * @return \Illuminate\Http\Response
     */
    public function destroy(UHealthcare $uHealthcare)
    {
        //
    }
}
