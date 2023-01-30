<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'project_id', 'facebook', 'twitter', 'instagram', 'youtube', 'website', 'meetup', 'others'
    ];
}
