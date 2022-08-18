<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameName extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];
    public function SurveySubmission()
    {
        return $this->hasOne(SurveySubmission::class,'game_id','id')->select('user_id', 'id', 'game_id', 'options');
    }
}