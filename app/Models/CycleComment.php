<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CycleComment extends Model
{
    use HasFactory;
    protected $fillable =['date', 'comment', 'start_time', 'end_time', 'module'];

    public function UserAttendance()
    {
        return $this->hasMany(UserAttendance::class, 'cycle_comment_id', 'id')->select('id', 'user_id', 'cycle_comment_id', 'time_period', 'status');
    }

    public function CycleTrackImage()
    {
        return $this->hasMany(CycleTrackImage::class, 'cycle_comment_id', 'id')->select('id', 'user_id', 'cycle_comment_id', 'image', 'system_name');
    }

    public function UserComments ()
    {
        return $this->hasMany(CafeUserComment::class, 'cycle_comment_id', 'id')->select('id', 'user_id',	'cycle_comment_id', 'comment');
    }
}

