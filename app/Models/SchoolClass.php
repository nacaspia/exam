<?php

namespace App\Models;

use App\Traits\SeoTrait;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    use SeoTrait;
    protected $table = 'school_classes';
    protected $fillable = [
        'title', 'slug', 'text', 'image', 'status'
    ];

    protected $casts = [
        'title' => 'array',
        'slug' => 'array',
        'text' => 'array'
    ];
}
