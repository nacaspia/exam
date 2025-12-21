<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model
{
    protected $table = 'question_options';
    protected $fillable = [
        'question_id', 'option', 'is_correct'
    ];

    protected $casts = [
        'option' => 'array'
    ];
}
