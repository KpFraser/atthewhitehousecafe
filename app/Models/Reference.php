<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    use HasFactory;
    protected $fillable = [
        'reference_email', 'project_id', 'role_id', 'application_id', 'user_id', 'payload'
    ];
}
