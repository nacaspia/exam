<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    protected $table = 'question_answers';
    protected $fillable = [
        'question_id', 'correct_answer'
    ];
}
