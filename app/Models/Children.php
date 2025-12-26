<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Children extends Model
{
    protected $table = 'children';
    protected $fillable = [
        'user_id',
        'name',
        'surname',
        'class_id',
        'is_deleted'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function class()
    {
        return $this->belongsTo(SchoolClass::class);
    }
}
