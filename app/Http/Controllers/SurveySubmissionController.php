<?php

namespace App\Http\Controllers;

use App\Models\GameName;
use App\Models\SurveySubmission;
use Illuminate\Http\Request;
use App\Http\Resources\SurveySubmissionResource;


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
        // dd($request->answers);
        // echo "<pre>";
        // echo $key;
        if($request->answers != ""){
            foreach ($request->answers as $key => $ans) {
                if ($ans != "") {
                    SurveySubmission::updateOrCreate([
                        'game_id'=> $key,
                    ],[
                        'user_id'=> auth()->id(),
                        'options'=> $ans,
                    ]);
                };
            }
            return response()->success();
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
