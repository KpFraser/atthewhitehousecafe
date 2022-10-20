<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RosterImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'event_id', 'image_name', 'system_name'
    ];
}
