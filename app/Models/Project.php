<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'name', 'location', 'frequency', 'requirements', 'leadership', 'module', 'is_approved', 'is_archived', 'is_key', 'created_by', 'updated_by'
    ];

    public function user_project()
    {
        return $this->hasOne(ProjectUser::class,'project_id','id')->select('project_id', 'id', 'is_user');
    }
}
