<?php

namespace App\Models;

use App\Traits\SeoTrait;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use SeoTrait;
    protected $table = 'subjects';
    protected $fillable = [
        'name', 'slug', 'text', 'image', 'status'
    ];

    protected $casts = [
        'name' => 'array',
        'slug' => 'array',
        'text' => 'array'
    ];

    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoable');
    }
}
