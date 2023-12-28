<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewAccountNotification;

class UserService
{
    public function create(array $userData): User
    {
        // creating a user account
        $user = User::create($userData);

        Auth::login($user);

        // Sending email
        Notification::route('mail', 'test@test.com')->notify(new NewAccountNotification($user));

        $this->syncRoles($user->id, $userData['role_id']);

        return $user;
    }

    public function save(User $user, array $data):  User
    {
        // updateing a role
        $user->update($data);

        $this->syncRoles($user->id, $data['role_id']);

        return $user;
    }

    public function syncRoles(int $userId, int $roleId)
    {
        // getting role relative of the user
        $role = UserRole::where('user_id', $userId)
            ->first() ?? new UserRole();
        $role->fill(['role_id' => $roleId, 'user_id' => $userId]);
        $role->save();
    }
}
