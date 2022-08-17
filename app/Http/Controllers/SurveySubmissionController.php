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
        // dd(auth()->user()->id);
        // echo "<pre>";
        // echo $key;
        if($request->answers != ""){
            foreach ($request->answers as $key => $ans) {
                if ($ans != "") {
                    SurveySubmission::updateOrCreate([
                        'game_id'=> $key,
                    ],[
                        'user_id'=> auth()->user()->id,
                        'options'=> $ans,
                    ]);
                };
            };
            SurveyContact::updateOrCreate([
                'user_id'=> auth()->user()->id,
            ],[
                'name'=> $request->name,
                'email'=> $request->email,
                'phone_number'=> $request->phone_number,
            ]);
            return response()->success();
            Mail::to('salman9607@gmail.com')->send(new SurveyMail());
        }else{
            return response()->error(500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SurveySubmission  $surveySubmission
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data = GameName::select('id', 'name')->get();
        return response($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SurveySubmission  $surveySubmission
     * @return \Illuminate\Http\Response
     */
    public function edit(SurveySubmission $surveySubmission)
    {
        //
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