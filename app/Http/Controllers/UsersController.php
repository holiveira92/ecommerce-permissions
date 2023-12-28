<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Inertia\Inertia;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Account\StoreRequest;
use App\Http\Requests\Account\UpdateRequest;
use App\Providers\RouteServiceProvider;

class UsersController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return Inertia::render('Users/Index', [
            'accounts' => User::with('roles.role')->get()
        ]);
    }

    public function create()
    {
        $roles = Role::all()->toArray();

        return Inertia::render('Users/Create', compact('roles'));
    }

    public function store(StoreRequest $request)
    {
        try {
            $this->userService->create($request->validated());

            return redirect()->route('users.index')->with('success', 'User account created successfully.');

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit(User $user)
    {
        $roles = Role::all()->toArray();
        $userRoles = $user->roles?->toArray() ?? [];

        return Inertia::render('Users/Edit', compact('user', 'roles', 'userRoles'));
    }

    public function update(UpdateRequest $request, User $user)
    {
        $user = $this->userService->save($user, $request->validated());

        return redirect()->route('users.index')->with('success', 'User account updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User account deleted successfully.');
    }
}
