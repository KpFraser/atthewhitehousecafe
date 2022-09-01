<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EventController extends Controller
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
    public function showInfo($id)
    {
        $data = Event::select('name', 'created_at')->where('id', $id)->get();
//        dd($data[0]->created_at);
        if (!empty($data[0]->created_at))
        {
            $month = Carbon::parse($data[0]->created_at)->format('F');
            $date = Carbon::parse($data[0]->created_at)->format('d');
            $event_year = Carbon::parse($data[0]->created_at)->format('Y');
            $event_start = Carbon::parse($data[0]->created_at)->format('h:i a');
            $event_end = Carbon::parse($data[0]->created_at)->addHour()->format('h:i a');
//            dd($event_end);
            return response([$month, $date, $event_year, $event_start, $event_end]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Event::Create([
            'user_id'=> auth()->user()->id,
            'name'=> $request->name,
        ]);
        return response()->success();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        $data = Event::select('id', 'name')->get();
        return response($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}