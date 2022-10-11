<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bike extends Model
{
    use HasFactory;
    protected $fillable =  [
        'project_id', 'name', 'slug', 'rating', 'mobile', 'comment', 'leader', 'assistant', 'image_name', 'system_name', 'estimated_cost', 'actual_cost'
    ];
}
