<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePageSetting extends Model
{
    protected $fillable = [
        'section_name',
        'content',
        'images'
    ];

    protected $casts = [
        'content' => 'array',
        'images' => 'array',
    ];
}
