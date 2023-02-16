<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CafeUserComment extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id', 'comment', 'cycle_comment_id'
    ];
}
