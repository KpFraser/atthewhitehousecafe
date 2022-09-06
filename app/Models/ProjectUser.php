<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'project_id', 'is_user', 'is_key'
    ];
    public function key_project()
    {
        return $this->belongsTo(Project::class,'project_id', 'id')->select( 'id', 'name', 'frequency');
    }
    public function project_users()
    {
      return $this->belongsTo(User::class,'user_id', 'id')->select( 'id', 'name');
    }
}
