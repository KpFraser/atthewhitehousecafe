<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UHealthcare extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'emergency_name',
        'emergency_contact',
        'dr_name',
        'dr_contact',
        'user_id',
    ];
}
