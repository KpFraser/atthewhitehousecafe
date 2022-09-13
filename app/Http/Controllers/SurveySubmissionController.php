<?php

namespace App\Http\Controllers;

use App\Models\GameName;
use App\Mail\SurveyMail;
use App\Models\Project;
use App\Models\SurveySubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\SurveySubmissionResource;
use App\Models\SurveyContact;
use Session;
use phpDocumentor\Reflection\Types\Null_;

class SurveySubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = GameName::select('id', 'name')->get();
        return response($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function surveyProject(Request $request)
    {
        if ($request->check === true) {
            GameName::updateorcreate([
                'name' => $request->name
            ]);
        }else{
            $data = GameName::select()->where('name', $request->name)->delete();
        }
        return response()->success();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $survey_contact = SurveyContact::updateOrCreate([
            'session_id'=> Session::getId(),
        ],[
            'name'=> $request->survey['name'],
            'email'=> $request->survey['email'],
            'phone_number'=> $request->survey['phone_number'],
        ]);

        foreach($request->selected as $key=>$ans){

            SurveySubmission::updateOrCreate([
                'session_id'=> Session::getId(),
                'game_id'=> $key,
            ],[
                'options'=> $ans,
                'survey_contact_id'=> $survey_contact->id,
            ]);
        }
        return response()->success();

        Mail::to('salman9607@gmail.com')->send(new SurveyMail());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SurveySubmission  $surveySubmission
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data = Project::select('id', 'name')->get();
        return response($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SurveySubmission  $surveySubmission
     * @return \Illuminate\Http\Response
     */
    public function option(Request $request)
    {
        // if($request->id != ""){
        //     SurveySubmission::updateOrCreate([
        //             'session_id'=> Session::getId(),
        //             'game_id'=> $request->id,
        //         ],[
        //             'session_id'=> Session::getId(),
        //             'options'=> $request->option,
        //             'survey_contact_id'=> 1,
        //         ]);

        //     return response()->success();
        // }else{
        //     return response()->error(500);
        // }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SurveySubmission  $surveySubmission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        GameName::updateOrCreate([
            'id'=> $request->name['id'],
        ],[
            'name'=> $request->name['name'],
        ]);
        return response()->success();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SurveySubmission  $surveySubmission
     * @return \Illuminate\Http\Response
     */
    public function destroy(SurveySubmission $surveySubmission)
    {
        //
    }
}
