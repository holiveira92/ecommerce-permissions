<?php

namespace App\Services;

use App\Models\Permission;

class PermissionService
{
    public function create(array $permissionData): Permission
    {
        $permission = Permission::create($permissionData);

        return $permission;
    }

    public function save(Permission $permission, array $data): Permission
    {
        $permission->update($data);

        return $permission;
    }
}
