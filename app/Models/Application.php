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


}
