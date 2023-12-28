<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    protected $table = 'role_permissions';

    protected $fillable = [
        'role_id',
        'permission_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function roles()
    {
        return $this->hasMany(Role::class);
    }

    public function permission()
    {
        return $this->hasMany(Permission::class);
    }
}
