<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'name', 'location', 'frequency', 'requirements', 'leadership', 'module', 'is_approved', 'is_user', 'is_archived', 'is_key', 'created_by', 'updated_by'
    ];
}
