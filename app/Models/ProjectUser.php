<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'project_id', 'comment', 'is_user', 'is_roster', 'is_key', 'system_name', 'roster_image',
    ];
    public function key_project()
    {
        return $this->belongsTo(Project::class,'project_id', 'id')->select( 'id', 'name', 'frequency', 'slug');
    }
    public function project_users()
    {
      return $this->belongsTo(User::class,'user_id', 'id')->select( 'id', 'name');
    }
    public function project_users_images()
    {
        return $this->hasMany(ProjectUserImages::class,'project_user_id', 'id');
    }
    public function project_names()
    {
        return $this->belongsTo(Project::class,'project_id', 'id')->select( 'id', 'name', 'slug', 'is_archived')->orderBy('name');
    }
}
