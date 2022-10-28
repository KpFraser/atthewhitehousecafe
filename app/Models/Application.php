<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id', 'role_id', 'name', 'text1', 'text2', 'text3', 'email', 'ref1_email', 'ref2_email', 'created_by', 'updated-by'
    ];

    public function ProjectsName ()
    {
        return $this->belongsTo(Project::class,'project_id')->select('id', 'name');
    }

    public function ApplicationRoles ()
    {
        return $this->belongsTo(Role::class,'role_id')->select('id', 'name');
    }

}
