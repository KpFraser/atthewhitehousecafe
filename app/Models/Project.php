<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'name', 'location', 'frequency', 'requirements', 'leadership', 'module', 'is_approved', 'is_archived', 'is_key', 'created_by', 'updated_by'
    ];

    public function projectUser(): HasOne
    {
        return $this->hasOne(ProjectUser::class,'project_id','id')->select('project_id', 'id', 'is_user')->where('user_id', auth()->user()->id);
    }
}
