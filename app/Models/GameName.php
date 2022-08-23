<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class GameName extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];
    public function SurveySubmission()
    {
        return $this->hasOne(SurveySubmission::class,'game_id')->select('id', 'game_id', 'options')->where('session_id', Session::getId());
    }
}
