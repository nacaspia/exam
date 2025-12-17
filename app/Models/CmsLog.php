<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsLog extends Model
{
    protected $table = 'cms_logs';

    protected $fillable = [
        'cms_user_id',
        'obj_id',
        'obj_table',
        'action',
        'description',
        'ip',
        'datetime',
    ];
}
