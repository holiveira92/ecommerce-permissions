<?php

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $user = User::create([
                'name' => fake()->name() . " Master-Admin",
                'email' => "superadmin@admin.com",
                'password' => Hash::make('123456'),
        ]);
        $role = Role::where('name', "SuperAdmin")->first();
        $this->createRole($user->id, $role->id);

        $user = User::create([
            'name' => fake()->name(),
            'email' => "admin@admin.com",
            'password' => Hash::make('123456'),
        ]);
        $role = Role::where('name', "Admin")->first();
        $this->createRole($user->id, $role->id);

        $user = User::create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('123456'),
        ]);
        $role = Role::where('name', "Operator")->first();
        $this->createRole($user->id, $role->id);

        $user = User::create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('123456'),
        ]);
        $role = Role::where('name', "Customer1")->first();
        $this->createRole($user->id, $role->id);

        $user = User::create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('123456'),
        ]);
        $role = Role::where('name', "Customer2")->first();
        $this->createRole($user->id, $role->id);

        $user = User::create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('123456'),
        ]);
        $role = Role::where('name', "Customer-Debt")->first();
        $this->createRole($user->id, $role->id);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }

    public function createRole(int $userId, int $roleId)
    {
        $role = new UserRole();
        $role->fill(['role_id' => $roleId, 'user_id' => $userId]);
        $role->save();
    }
};
