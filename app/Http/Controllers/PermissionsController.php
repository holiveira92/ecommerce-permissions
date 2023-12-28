<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Permission;
use App\Services\PermissionService;
use App\Http\Requests\Permission\StoreRequest;
use App\Http\Requests\Permission\UpdateRequest;

class PermissionsController extends Controller
{
    protected PermissionService $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Permissions/Index', [
            'permissions' => Permission::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all()->toArray();

        return Inertia::render('Permissions/Create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {
            $role = $this->permissionService->create($request->validated());

        } catch (\Throwable $th) {
            throw $th;
        }

        return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        $permissionsList = Permission::all()->toArray();

        return Inertia::render('Permissions/Edit', compact('permission', 'permissionsList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Permission $permission)
    {
        try {
            $permission = $this->permissionService->save($permission, $request->validated());

            return redirect()->route('permissions.index')->with('success', 'Permission updated successfully.');

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully.');
    }
}
