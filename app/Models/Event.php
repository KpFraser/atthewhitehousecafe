<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'name', 'project_id', 'module', 'slug', 'group_comment', 'event_date', 'start_time', 'end_time'
        ];
    public function UserAttendance()
    {
        return $this->hasMany(UserAttendance::class, 'event_id', 'id')->select('id', 'user_id', 'event_id', 'time_period', 'status');
    }

    public function CycleTrackImage()
    {
        return $this->hasMany(CycleTrackImage::class, 'event_id', 'id')->select('id', 'user_id', 'event_id', 'image', 'system_name');
    }

    public function UserComments ()
    {
        return $this->hasMany(CafeUserComment::class, 'event_id', 'id')->select('id', 'user_id',	'event_id', 'comment', 'image');
    }
}
