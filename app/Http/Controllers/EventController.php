<?php

namespace App\Http\Controllers;

use App\Http\Resources\RosterProjectResource;
use App\Mail\ParticipantMail;
use App\Models\Event;
use App\Models\Project;
use Illuminate\Validation\Rules;
use App\Models\ProjectUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Str;


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
    public function showInfo($event_slug, $project_slug)
    {
        $data = Event::select('name', 'created_at', 'slug')->where('slug', $event_slug)->get();
        if (!empty($data[0]->created_at))
        {
            $month = Carbon::parse($data[0]->created_at)->format('F');
            $date = Carbon::parse($data[0]->created_at)->format('d');
            $event_year = Carbon::parse($data[0]->created_at)->format('Y');
            $event_start = Carbon::parse($data[0]->created_at)->format('h:i a');
            $event_end = Carbon::parse($data[0]->created_at)->addHour()->format('h:i a');

            $project_id = Project::select('id')->where('slug', $project_slug)->get();

            $data1 = ProjectUser::with('project_users')->where(array('project_id'=>$project_id[0]->id, 'is_key'=> 1))->get();
            $data2 = RosterProjectResource::Collection($data1);
            $data3 = Event::select('id','slug', 'group_comment')->where( 'slug', $event_slug)->get();

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
        // dd($request->all());
        $request->validate([
            'name' => 'required|unique:events,name,'.$request->name,
        ]);
        if($request->slug !== null){
            $project_id = Project::select('id')->where('slug', $request->slug)->first();
            Event::Create([
                'user_id'=> auth()->user()->id,
                'name'=> $request->name,
                'project_id'=> $project_id->id,
                'slug' => Str::slug($request->name),
            ]);
        }else{
            $project_id = ProjectUser::select('project_id')->where(array('is_key'=> 1, 'user_id'=> auth()->user()->id))->first();
            Event::Create([
                'user_id'=> auth()->user()->id,
                'name'=> $request->name,
                'project_id'=> $project_id->project_id,
                'slug' => Str::slug($request->name),
            ]);
        }

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
        //dd($request->all());
        if (!empty($request->project_slug)) {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
            ]);

            $participant = url('roster-confirmation/' . $request->email . '/' . $request->project_slug . '/' . $request->name . '/' .$request->event_slug.'/');
            Mail::to($request->email)->send(new ParticipantMail($participant));
            return response()->success();
        } else {
            return response()->error('Request Failed', 500);
        }
    }
    public function RosterConfirm(Request $request)
    {
//        dd($request->all());
        $project_id = Project::select('id')->where('slug', $request->project_slug)->first();
        if (!empty($project_id)) {
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
            if (!empty($user->id)){
                ProjectUser::create([
                    'user_id' => $user->id,
                    'project_id' => $project_id->id,
                    'is_user' => 1,
                    'is_key' => 1
                ]);
            }
            return response()->success();
        }else{
            return response()->error('Request Failed', 500);
        }
    }
    public function addParticipant(Request $request)
    {
        if (!empty($request->email)){

            $user_id = User::select('id')->where('email', $request->email)->first();
//            dd(!empty( $user_id));

            if (!empty( $user_id)) {
                $project_id = Project::select('id')->where('slug', $request->project_slug)->first();
                ProjectUser::updateOrCreate([
                    'project_id' => $project_id->id,
                    'user_id'=> $user_id->id,
                    'is_user'=> 1,
                    'is_key'=> 1,
                ]);
                return response()->success();
            } else {
                return response()->error('Email does not exist !', 500);
            }
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
            'slug' => $request->event_id,
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
