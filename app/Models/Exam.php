<?php

namespace App\Models;

use App\Traits\SeoTrait;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use SeoTrait;
    protected $table = 'exams';
    protected $fillable = [
        'user_id',
        'class_id',
        'title',
        'slug',
        'text',
        'image',
        'price_type',
        'price',
        'is_paid',
        'start_time',
        'end_time',
        'duration',
        'duration_type',
        'question_count',
        'language',
        'description',
        'random_questions',
        'show_result',
        'active'
    ];

    protected $casts = [
        'title' => 'array',
        'slug' => 'array',
        'text' => 'array',
    ];

    public function class()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function questions()
    {
        return $this->belongsToMany(
            Question::class,
            'exam_questions',
            'exam_id',
            'question_id'
        );
    }


    public function results()
    {
        return $this->hasMany(ExamResult::class);
    }

}
