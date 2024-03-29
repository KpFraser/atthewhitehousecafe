<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAttendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'time_period', 'comment', 'status', 'event_id'
    ];
}
