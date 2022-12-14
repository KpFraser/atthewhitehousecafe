<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyContact extends Model
{
    use HasFactory;
    protected $fillable = [
        'session_id',
        'name',
        'phone_number',
        'email'
    ];
}
