<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Safety extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'document', 'document_path', 'date', 'text1', 'text2', 'text3'
    ];
}
