<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'project_id', 'address_1', 'address_2', 'city', 'postcode', 'country', 'repeat_time', 'repeat_every', 'repeat_on', 'never', 'on', 'after', 'created_by', 'updated_by'
    ];
}
