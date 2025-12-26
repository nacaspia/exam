<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $fillable = [
        'user_id',
        'exam_id',
        'amount',
        'provider',
        'transaction_id',
        'status',
    ];
}
