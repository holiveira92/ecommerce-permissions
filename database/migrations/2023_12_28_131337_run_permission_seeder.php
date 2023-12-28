<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Permission;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Permission::create(
            [
                'name' => "Full Access",
                'excluded_routes' => null,
            ],
            [
                'name' => "Cannot See SuperAdmin Routes",
                'excluded_routes' => "users, roles, permissions",
            ],
            [
                'name' => "Cannot See Flight Products",
                'excluded_routes' => "flights",
            ],
            [
                'name' => "Cannot See Rent Car Products",
                'excluded_routes' => "rent, car",
            ],
            [
                'name' => "Cannot See Checkout",
                'excluded_routes' => "checkout",
            ],
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
