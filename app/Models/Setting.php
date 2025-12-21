<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';
    protected $fillable = [
        'title',
        'text',
        'logo',
        'contact'
    ];

    protected $casts = [
        'title' => 'array',
        'text' => 'array',
        'logo' => 'array',
        'contact' => 'array'
    ];
}
