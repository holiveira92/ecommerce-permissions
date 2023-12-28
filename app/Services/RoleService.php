<?php

namespace App\Services;

use App\Models\Role;
use App\Models\Permission;

class RoleService
{
    public function create(array $roleData, array $permissionIds): Role
    {
        // creating a role
        $role = Role::create($roleData);

        // getting permissions relative of the given names
        $permissions = Permission::whereIn('id', $permissionIds)->get();

        // associating permissions to the role
        $role->permissions()->attach($permissions);

        return $role;
    }

    public function save(Role $role, array $data,  array $permissionIds): Role
    {
        // updateing a role
        $role->update($data);

        // getting permissions relative of the given names
        $permissions = Permission::whereIn('id', $permissionIds)->get();

        // associating and syncing the old and new permissions to the role
        $role->permissions()->sync($permissions);

        return $role;
    }
}
