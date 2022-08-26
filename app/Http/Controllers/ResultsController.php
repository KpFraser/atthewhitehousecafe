<?php

namespace App\Http\Controllers;

use App\Models\SurveySubmission;
use Illuminate\Http\Request;

class ResultsController extends Controller
{
    public function show()
    {
        $result = SurveySubmission::select('game_id', 'options')->get();
         return response($result);
    }
}
