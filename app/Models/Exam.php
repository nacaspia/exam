<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = 'exams';
    protected $fillable = [
        'class_id',
        'title',
        'is_paid',
        'start_time',
        'end_time',
        'duration',
        'question_count',
        'language',
        'description',
        'random_questions',
        'show_result',
        'active'
    ];

    protected $casts = [
        'title' => 'array',
    ];

    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }
}
