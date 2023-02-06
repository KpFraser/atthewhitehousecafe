<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'slug', 'location', 'is_survey', 'frequency', 'requirements', 'is_approved', 'is_archived', 'created_by', 'updated_by'
    ];

    public function projectUserInfo()
    {
        if(auth()->check())
        return $this->hasOne(ProjectUser::class,'project_id', 'id')->where(array('user_id'=> auth()->user()->id));
        else
        return $this->hasOne(ProjectUser::class,'project_id', 'id');
    }

    public function ProjectLocation ()
    {
        return $this->hasOne(Location::class, 'project_id', 'id');
    }

    public function ProjectRisk ()
    {
        return $this->hasMany(RiskManagement::class, 'project_id', 'id')->select('id', 'user_id', 'project_id', 'name', 'risk', 'control');
    }

    public function ProjectSafety ()
    {
        return $this->hasOne(Safety::class, 'project_id', 'id')->select('id', 'user_id', 'project_id', 'document', 'document_path', 'text1', 'text2', 'text3', 'date');
    }

    public function ProjectFunding ()
    {
        return $this->hasOne(Funding::class, 'project_id', 'id');
    }

    public function ProjectMedia ()
    {
        return $this->hasOne(SocialMedia::class, 'project_id', 'id');
    }
}
