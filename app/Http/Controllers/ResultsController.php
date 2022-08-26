<?php

namespace App\Http\Controllers;

use App\Models\GameName;
use App\Models\SurveySubmission;
use Illuminate\Http\Request;

class ResultsController extends Controller
{
    public function show()
    {
        $name = GameName::select('id', 'name')->get();
        $result = SurveySubmission::select('game_id', 'options')->get();
         return response([$result, $name]);
    }
}
