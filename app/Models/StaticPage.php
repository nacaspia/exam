<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaticPage extends Model
{
    protected $table = 'static_pages';
    protected $fillable = [
        'title', 'slug', 'text', 'full_text', 'image', 'type'
    ];

    protected $casts = [
        'title' => 'array',
        'slug' => 'array',
        'text' => 'array',
        'full_text' => 'array'
    ];
}
