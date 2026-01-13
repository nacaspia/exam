<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'surname',
        'parent',
        'phone',
        'email',
        'password',
        'type',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
//            'password' => 'hashed',
        ];
    }

    // User.php
    public function isStudent()
    {
        return $this->type === 'student';
    }

    public function isParent()
    {
        return $this->type === 'parent';
    }

    // User.php
    public function children()
    {
        return $this->hasMany(Children::class, 'user_id');
    }

    public function examResults()
    {
        return $this->hasMany(ExamResult::class);
    }

}
