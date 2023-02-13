<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CycleTrackImage extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id', 'cycle_comment_id', 'image', 'system_name'
    ];
}
