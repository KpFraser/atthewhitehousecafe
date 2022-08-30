<?php

namespace App\Http\Controllers;

use App\Models\GameName;
use App\Models\SurveyContact;
use App\Models\SurveySubmission;
use Illuminate\Http\Request;

class ResultsController extends Controller
{
    public function show()
    {
        $contractIds = [];
        $name = GameName::select('id', 'name')->get();
        $result = SurveySubmission::select('game_id', 'options', 'survey_contact_id')->get();
        $contractUniqueIds = $result->unique('survey_contact_id');
        foreach($contractUniqueIds as $key => $row){
            array_push ($contractIds,  $row->survey_contact_id);
        }
       if(!empty($contractIds) && count($contractIds) > 0)
           $surveys = SurveyContact::select('id as contractId','name as c_name')->whereIn('id', $contractIds)->get();

         return json_encode(array('status' => 200,'data' => $result, 'data2' => $name, 'data3' => $surveys));
    }
}
