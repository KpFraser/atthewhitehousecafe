<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'project_id', 'is_user'
    ];
    public function key_project()
    {
        return $this->belongsTo(Project::class,'project_id','id')->select( 'id', 'is_key');
    }
}
