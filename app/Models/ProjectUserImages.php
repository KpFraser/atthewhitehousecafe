<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectUserImages extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'project_id', 'project_user_id', 'image_name', 'system_name'
    ];
}
