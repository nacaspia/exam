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

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
    public function studentAnswers() {
        return $this->hasMany(StudentAnswer::class, 'exam_result_id')->with(['question','questionOption']);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
