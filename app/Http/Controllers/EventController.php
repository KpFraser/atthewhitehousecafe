<?php

namespace App\Http\Controllers;

use App\Http\Resources\RosterProjectResource;
use App\Mail\ParticipantMail;
use App\Models\Event;
use App\Models\Project;
use App\Models\ProjectUserImages;
use App\Models\RosterImage;
use Illuminate\Support\Facades\File;
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
    public function findMail($search)
    {
        $data = User::select(['id', 'email'])->where('email', 'LIKE', "%$search%")->get();
        return response()->success($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showInfo($event_slug, $project_slug)
    {
        $data = Event::select('id', 'name', 'created_at', 'slug', 'event_date', 'start_time', 'end_time')->where('slug', $event_slug)->first();
        if (!empty($data->created_at)){
            $images = RosterImage::select('id', 'system_name', 'image_name')->where('event_id', $data->id)->get();

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

            $project_id = Project::select('id')->where('slug', $project_slug)->first();

            $data1 = ProjectUser::with('project_users', 'project_users_images')->where(array('project_id'=>$project_id->id))->get();
            $data2 = RosterProjectResource::Collection($data1);
//            dd($data2);
            $data3 = Event::select('id','slug', 'group_comment')->where( 'slug', $event_slug)->first();
            $data4 = ProjectUserImages::where(array('project_id'=>$project_id->id, 'user_id'=> auth()->user()->id))->get();

            return response()->success([$dateComp, $event_start, $event_end, $data2, $data3, $images, $data4]);
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
        $project_id = Project::select('id')->where('slug', $request->project_slug)->first();
//        dd($project_id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', Rules\Password::defaults()],
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if (!empty($user->id) && !empty($project_id)){
            ProjectUser::create([
                'user_id' => $user->id,
                'project_id' => $project_id->id,
                'is_user' => 1,
                'is_key' => 1
            ]);
        }
        return response()->success();
    }
    public function addParticipant(Request $request)
    {
        if (!empty($request->email)){
            $user_id = User::select('id')->where('email', $request->email)->first();
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
//        dd($request->all());
        $groupComment = json_decode($request->groupComment, true);
        $dateTime = json_decode($request->dateTime, true);
        $length = json_decode($request->length, true);
        $image_names = json_decode($request->image_name, true);

        $date1 = Carbon::parse($dateTime['start_time'])->format('H:i:s');
        $date2 = Carbon::parse($dateTime['end_time'])->format('H:i:s');

        $event = Event::updateOrCreate([
            'slug' => $groupComment['event_slug'],
        ],[
            'group_comment'=> $groupComment['comment'],
            'event_date'=> $dateTime['date'],
            'start_time'=> $date1,
            'end_time'=> $date2
        ]);
        for ($i=1; $i <= $length; $i++ ){
            if ($request->hasFile('image'.$i)) {
                $file1 = $request->file('image'.$i)->getClientOriginalName();
                $filename1 = pathinfo($file1, PATHINFO_FILENAME);
                $extension1 = pathinfo($file1, PATHINFO_EXTENSION);
                $image = $filename1.'-'.time().'.'.$extension1;
                $request->file('image'.$i)->move(public_path('storage/images/group'), $image);

                RosterImage::create([
                    'event_id' => $event->id,
                    'image_name'=> $file1,
                    'system_name'=> $image,
                ]);
            } elseif(count($image_names) === 0) {
                return response()->error('file missing', 500);
            }
        }

        if (!empty($length) && $length !== 0 && count($image_names) !== 0){
            foreach ($image_names as $item) {
                if (File::exists(storage_path('/app/public/images/group/') . $item['system_name'])) {
                    File::delete(storage_path('/app/public/images/group/') . $item['system_name']);
                }
                RosterImage::where('id', $item['id'])->delete();
            }
        }
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
