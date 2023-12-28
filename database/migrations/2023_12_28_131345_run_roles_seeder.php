<?php

use App\Models\Role;
use App\Models\Permission;
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
        $superadmin = Role::create([ 'name' => "SuperAdmin" ]);
        $permissions = Permission::whereIn('name', ['Full Access'])->get();
        $superadmin->permissions()->attach($permissions);

        $admin = Role::create([ 'name' => "Admin" ]);
        $permissions = Permission::whereIn('name', ['Full Access'])->get();
        $admin->permissions()->attach($permissions);

        $operator = Role::create([ 'name' => "Operator" ]);
        $permissions = Permission::whereIn('name', ['Cannot See SuperAdmin Routes'])->get();
        $operator->permissions()->attach($permissions);

        $customer1 = Role::create([ 'name' => "Customer1" ]);
        $permissions = Permission::whereIn('name', ['Cannot See Flight Products'])->get();
        $customer1->permissions()->attach($permissions);

        $customer2 = Role::create([ 'name' => "Customer2" ]);
        $permissions = Permission::whereIn('name', ['Cannot See Rent Car Products'])->get();
        $customer2->permissions()->attach($permissions);

        $customerDebt = Role::create([ 'name' => "Customer-Debt" ]);
        $permissions = Permission::whereIn('name', ['Cannot See Checkout'])->get();
        $customerDebt->permissions()->attach($permissions);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
