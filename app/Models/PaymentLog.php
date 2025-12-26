<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
    protected $table = 'payment_logs';
    protected $fillable = [
        'user_id',
        'payment_id',
        'payment_type_id',
        'amount',
        'data',
        'status',
    ];
    protected $casts = [
        'data' => 'array',
    ];
}
