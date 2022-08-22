<?php

namespace App\Http\Controllers;

use App\Models\GameName;
use App\Mail\SurveyMail;
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
            SurveyContact::updateOrCreate([
                'session_id'=> Session::getId(),
            ],[
                'name'=> $request->name,
                'email'=> $request->email,
                'phone_number'=> $request->phone_number,
            ]);

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
//        with('SurveySubmission')->get
        $data = GameName::with('SurveySubmission')->get();
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
        if($request->id != ""){
            SurveySubmission::updateOrCreate([
                    'session_id'=> Session::getId(),
                    'game_id'=> $request->id,
                ],[
                    'session_id'=> Session::getId(),
                    'options'=> $request->option,
                    'survey_contact_id'=> 1,
                ]);

            return response()->success();
        }else{
            return response()->error(500);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SurveySubmission  $surveySubmission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SurveySubmission $surveySubmission)
    {
        //
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
