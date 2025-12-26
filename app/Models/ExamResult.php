<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    protected $table = 'exam_results';
    protected $fillable = [
        'user_id',
        'exam_id',
        'total_score',
        'started_at',
        'finished_at',
        'status',
        'time_spent',
        'is_checked',
    ];
}
