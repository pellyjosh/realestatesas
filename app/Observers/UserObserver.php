<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Tenant\Wallet;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        // Create wallet for new user
        $user->wallet()->create([
            'currency' => 'NGN',
            'is_active' => true,
        ]);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        // Soft delete the wallet when user is deleted
        if ($user->wallet) {
            $user->wallet->update(['is_active' => false]);
        }
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        // Reactivate wallet when user is restored
        if ($user->wallet) {
            $user->wallet->update(['is_active' => true]);
        }
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
