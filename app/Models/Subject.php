<?php

namespace App\Models;

use App\Traits\SeoTrait;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use SeoTrait;
    protected $table = 'subjects';
    protected $fillable = [
        'title', 'slug', 'text', 'image', 'status'
    ];

    protected $casts = [
        'title' => 'array',
        'slug' => 'array',
        'text' => 'array'
    ];
}
