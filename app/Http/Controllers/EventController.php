<?php

namespace App\Http\Controllers;

use App\Http\Resources\RosterProjectResource;
use App\Models\Event;
use App\Models\ProjectUser;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;


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
    public function showInfo($event_id, $project_id)
    {
        $data = Event::select('name', 'created_at')->where('id', $event_id)->get();
        if (!empty($data[0]->created_at))
        {
            $month = Carbon::parse($data[0]->created_at)->format('F');
            $date = Carbon::parse($data[0]->created_at)->format('d');
            $event_year = Carbon::parse($data[0]->created_at)->format('Y');
            $event_start = Carbon::parse($data[0]->created_at)->format('h:i a');
            $event_end = Carbon::parse($data[0]->created_at)->addHour()->format('h:i a');

            $data1 = ProjectUser::with('project_users')->where(array('project_id'=>$project_id, 'is_key'=> 1))->get();
            $data2 = RosterProjectResource::Collection($data1);

            $data3 = Event::select('id', 'group_comment')->where( 'id', $project_id)->get();

            return response([$month, $date, $event_year, $event_start, $event_end, $data2, $data3]);
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
         //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function rosterRegister(Request $request)
    {
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            ProjectUser::create([
                'user_id'=> $user->id,
                'project_id'=>$request->project_id,
                'is_user'=>1,
                'is_key'=>1
            ]);
          return response()->success();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Event::updateOrCreate([
            'id' => $request->event_id,
        ],[
            'group_comment'=> $request->comment,
        ]);
        return response()->success();
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
