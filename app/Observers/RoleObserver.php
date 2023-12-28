<?php

namespace App\Observers;

use App\Models\Role;
use App\Notifications\NewRoleNotification;
use Illuminate\Support\Facades\Notification;

class RoleObserver
{
    /**
     * Handle the Role "created" event.
     */
    public function created(Role $role): void
    {
        // Sending email
        Notification::route('mail', 'test@test.com')->notify(new NewRoleNotification($role));
    }

    /**
     * Handle the Role "updated" event.
     */
    public function updated(Role $role): void
    {
        //
    }

    /**
     * Handle the Role "deleted" event.
     */
    public function deleted(Role $role): void
    {
        //
    }

    /**
     * Handle the Role "restored" event.
     */
    public function restored(Role $role): void
    {
        //
    }

    /**
     * Handle the Role "force deleted" event.
     */
    public function forceDeleted(Role $role): void
    {
        //
    }
}
