<?php

namespace App\Models;

use App\Traits\SeoTrait;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use SeoTrait;
    protected $table = 'questions';
    protected $fillable = [
        'class_id', 'subject_id', 'title', 'slug', 'text', 'image', 'type', 'score', 'is_paid', 'price'
    ];

    protected $casts = [
        'title' => 'array',
        'slug' => 'array',
        'text' => 'array'
    ];

    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoable');
    }
    public function class()
    {
        return $this->hasOne(SchoolClass::class,'id','class_id');
    }

    public function subject()
    {
        return $this->hasOne(Subject::class,'id','subject_id');
    }

    public function options()
    {
        return $this->hasMany(QuestionOption::class);
    }

    public function answer()
    {
        return $this->hasOne(QuestionAnswer::class);
    }
}
