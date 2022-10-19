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
        $data = Event::select('name', 'created_at', 'slug', 'event_date', 'start_time', 'end_time')->where('slug', $event_slug)->first();
        if (!empty($data->created_at)){
            if(empty($data->event_date && $data->start_time && $data->end_time)){
                $month = Carbon::parse($data->created_at)->format('m');
                $date = Carbon::parse($data->created_at)->format('d');
                $event_year = Carbon::parse($data->created_at)->format('Y');
                $event_start = Carbon::parse($data->created_at)->format('h:i');
                $event_end = Carbon::parse($data->created_at)->addHour()->format('h:i');
                $dateComp = $event_year.'-'.$month.'-'.$date;
            } else{
                $dateComp = $data->event_date;
                $event_start = $data->start_time;
                $event_end = $data->end_time;
            }

//                $date = Carbon::parse($data->created_at)->format('d');
//                $event_year = Carbon::parse($data->created_at)->format('Y');
//            info.value.date =  response.data[2]+'-'+response.data[0]+'-'+response.data[1]


            $project_id = Project::select('id')->where('slug', $project_slug)->first();

            $data1 = ProjectUser::with('project_users')->where(array('project_id'=>$project_id->id, 'is_key'=> 1))->get();
            $data2 = RosterProjectResource::Collection($data1);
            $data3 = Event::select('id','slug', 'group_comment')->where( 'slug', $event_slug)->first();

            return response([$dateComp, $event_start, $event_end, $data2, $data3]);
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
            $data1 = Project::select('id')->where('slug', $request->slug)->first();
            $project_id = $data1->id;
        }else{
            $data2 = ProjectUser::select('project_id')->where(array('is_key'=> 1, 'user_id'=> auth()->user()->id))->first();
            $project_id = $data2->project_id;
        }
        Event::Create([
            'user_id'=> auth()->user()->id,
            'name'=> $request->name,
            'project_id'=> $project_id,
            'slug' => Str::slug($request->name),
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
        $date1 = Carbon::parse($request->datetime['start_time'])->format('H:i:s');
        $date2 = Carbon::parse($request->datetime['end_time'])->format('H:i:s');

        Event::updateOrCreate([
            'slug' => $request->comment['event_id'],
        ],[
            'group_comment'=> $request->comment['comment'],
            'event_date'=> $request->datetime['date'],
            'start_time'=> $date1,
            'end_time'=> $date2
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
