<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions');
    }

    public function hasPermission($permissionName)
    {
        return $this->permissions->contains('name', $permissionName);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_users');
    }
}
