<?php

namespace App\Http\Controllers;

use App\Models\GameName;
use App\Mail\SurveyMail;
use App\Models\SurveySubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\SurveySubmissionResource;
use App\Models\SurveyContact;

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
                'user_id'=> auth()->user()->id,
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
                    'game_id'=> $request->id,
                ],[
                    'user_id'=> auth()->user()->id,
                    'options'=> $request->option,
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
