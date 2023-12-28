<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Account\StoreRequest;
use App\Http\Requests\Account\UpdateRequest;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests\Account\DestroyRequest;
use App\Notifications\NewAccountNotification;

class UsersController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $accounts = User::all();
        return Inertia::render('Users/Index', [
            'accounts' => $accounts
        ]);
    }

    public function create()
    {
        $roles = Role::all()->toArray();

        return Inertia::render('Users/Create', compact('roles'));
    }

    public function store(StoreRequest $request)
    {
        //try {
            /*
            $data = $request->validated();

            $user = User::create($data);

            Auth::login($user);

            // Sending email
            Notification::route('mail', 'test@test.com')->notify(new NewAccountNotification($user));
            */
            $user = $this->userService->create($request->validated());

            /*
        } catch (\Throwable $th) {
            throw $th;
        }
        */

        return redirect()->route('users.index')->with('success', 'User account created successfully.');
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
