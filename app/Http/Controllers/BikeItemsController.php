<?php

namespace App\Http\Controllers;

use App\Models\BikeItems;
use Illuminate\Http\Request;

class BikeItemsController extends Controller
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
//         dd($request->all);
         foreach ($request->all() as $data){
             foreach ($data as $row){
                 echo '<pre>';
                 echo $row;
             }
         }
    }

    public function storefinal(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BikeItems  $bikeItems
     * @return \Illuminate\Http\Response
     */
    public function show(BikeItems $bikeItems)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BikeItems  $bikeItems
     * @return \Illuminate\Http\Response
     */
    public function edit(BikeItems $bikeItems)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BikeItems  $bikeItems
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BikeItems $bikeItems)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BikeItems  $bikeItems
     * @return \Illuminate\Http\Response
     */
    public function destroy(BikeItems $bikeItems)
    {
        //
    }
}
