<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'name',
        'content',
        'text_1_icon',
        'text_1_title',
        'text_1_content',
        'text_2_icon',
        'text_2_title',
        'text_2_content',
        'text_3_icon',
        'text_3_title',
        'text_3_content',
    ];
}
