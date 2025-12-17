<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionLabel extends Model
{
    protected $fillable = ['name'];

    public function permissions()
    {
        return $this->hasMany(Permission::class,'permission_label_id','id')->orderBy('name','ASC');
    }
}
