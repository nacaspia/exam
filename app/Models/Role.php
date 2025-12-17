<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];

    public function permissionSave() {
        return $this->belongsToMany(Permission::class, 'role_permissions');
    }

    public function users() {
        return $this->belongsToMany(CmsUser::class, 'cms_user_roles');
    }

    public function permissions() {
        return $this->hasMany(RolePermission::class, 'role_id', 'id')->select('permission_id', 'role_id');
    }
}
