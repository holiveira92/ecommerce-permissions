<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Inertia\Inertia;
use App\Models\Permission;
use App\Services\RoleService;
use App\Http\Requests\Role\StoreRequest;
use App\Http\Requests\Role\UpdateRequest;
use App\Notifications\NewRoleNotification;
use Illuminate\Support\Facades\Notification;

class RolesController extends Controller
{
    protected RoleService $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Roles/Index', [
            'roles' => Role::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all()->toArray();

        return Inertia::render('Roles/Create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {
            $roleData = $request->validated();

            $permissionsIds = collect($roleData['selected'] ?? [])->pluck('value')->toArray();

            $role = $this->roleService->create($roleData, $permissionsIds);

        } catch (\Throwable $th) {
            throw $th;
        }

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all()->toArray();

        $rolePermissions = $role->permissions->toArray();

        return Inertia::render('Roles/Edit', compact('role', 'rolePermissions', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Role $role)
    {
        try {
            $roleData = $request->validated();

            $permissionsIds = collect($roleData['selected'] ?? [])->pluck('value')->toArray();

            $role = $this->roleService->save($role, $roleData, $permissionsIds);

            return redirect()->route('roles.index')->with('success', 'Role updated successfully.');

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
