<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name',
        'excluded_routes'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function roles()
    {
        return $this->belongsToMany(RolePermission::class);
    }
}
