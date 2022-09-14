<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveySubmission extends Model
{
    use HasFactory;
    protected $fillable = [
        'session_id',
        'project_id',
        'options',
        'survey_contact_id',
    ];
}
