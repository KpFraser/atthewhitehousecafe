<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'user_id', 'name', 'location', 'frequency', 'requirements', 'leadership', 'module', 'is_approved', 'is_user', 'is_archieved', 'is_key'
    ];
}
