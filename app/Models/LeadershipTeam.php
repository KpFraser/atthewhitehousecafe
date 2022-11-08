<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadershipTeam extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'organisers', 'leaders', 'assistants', 'mentors'
    ];
}
