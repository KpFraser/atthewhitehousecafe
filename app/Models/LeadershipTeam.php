<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadershipTeam extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','status', 'project_id', 'role', 'apply_appoint'
    ];

    public function checkUserName()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->select('id', 'name');
    }
}
