<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class CmsUser extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    public $table = 'cms_users';
    public $fillable = [
        'image',
        'name',
        'surname',
        'username',
        'phone',
        'email',
        'pin',
        'birthday',
        'password',
        'status',
        'last_login_at',
        'logout_login_at',
        'created_at',
        'updated_at',
    ];

    protected $hidden = ['password'];

    public function username()
    {
        return 'username';
    }

    public function roles() {
        return $this->belongsToMany(Role::class, 'cms_user_roles');
    }

    public function hasPermission($permission) {
        return Permission::where('name', $permission)
            ->whereHas('roles', function ($q) {
                $q->whereIn('roles.id', $this->roles->pluck('id'));
            })
            ->exists();
    }
}
