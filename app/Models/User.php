<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avarta',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Kiểm tra xem người dùng có quyền cụ thể hay không.
     *
     * @param  string  $permission
     * @return bool
     */
    public function hasPermission($permission)
    {
        // Kiểm tra logic xác định quyền ở đây
        // Ví dụ: Kiểm tra xem người dùng có quyền $permission hay không
        return $this->roles->flatMap->permissions->pluck('name')->contains($permission);
    }

    /**
     * Quan hệ với bảng roles.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users');
    }
    public function courses()
    {
        return $this->hasMany(Courses::class, 'instructor');
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_students')
            ->withTimestamps();
    }
}
