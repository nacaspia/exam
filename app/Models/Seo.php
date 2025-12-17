<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    protected $fillable = [
        'meta_title',
        'meta_text',
        'meta_slug',
        'meta_keywords',
        'canonical_url',
        'index',
        'follow',
        'og_title',
        'og_slug',
        'og_text',
        'og_image'
    ];

    protected $casts = [
        'meta_title' => 'array',
        'meta_text' => 'array',
        'meta_slug' => 'array',
        'meta_keywords' => 'array',
    ];

    public function seoable()
    {
        return $this->morphTo();
    }
}
