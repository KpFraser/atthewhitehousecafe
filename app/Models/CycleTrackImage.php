<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CycleTrackImage extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id', 'event_id', 'image', 'system_name'
    ];
}
