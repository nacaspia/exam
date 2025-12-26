<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
    protected $table = 'student_answers';
    protected $fillable = [
        'user_id',
        'child_id',
        'exam_result_id',
        'question_id',
        'question_option_id',
        'answer_text',
        'is_correct',
        'score',
        'time_spent',
        'answer_json',
    ];
    protected $casts = [
        'answer_json' => 'array',
    ];
}
