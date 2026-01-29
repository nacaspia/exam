<?php

namespace App\Models;

use App\Traits\SeoTrait;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use SeoTrait;
    protected $table = 'questions';
    protected $fillable = [
        'subject_id', 'user_id', 'title', 'slug', 'text', 'image', 'type', 'score'
    ];

    protected $casts = [
        'title' => 'array',
        'slug' => 'array',
        'text' => 'array'
    ];

    public function exams()
    {
        return $this->belongsToMany(
            Exam::class,
            'exam_questions',
            'question_id',
            'exam_id'
        );
    }

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

    /*public function options()
    {
        return $this->hasMany(QuestionOption::class);
    }*/

    public function answer()
    {
        return $this->hasOne(QuestionAnswer::class);
    }
    // VARIANTLI SUALLAR üçün
    public function options()
    {
        return $this->hasMany(QuestionOption::class);
    }

    // QISA YAZI (short_text) sualları üçün
    public function shortAnswer()
    {
        return $this->hasOne(QuestionAnswer::class);
    }
}
