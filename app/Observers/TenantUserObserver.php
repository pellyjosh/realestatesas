<?php

namespace App\Observers;

use App\Models\Tenant\TenantUser;
use App\Models\Tenant\Wallet;

class TenantUserObserver
{
    /**
     * Handle the TenantUser "created" event.
     */
    public function created(TenantUser $user): void
    {
        // Create wallet for new tenant user
        $user->wallet()->create([
            'currency' => 'NGN',
            'is_active' => true,
        ]);
    }

    /**
     * Handle the TenantUser "updated" event.
     */
    public function updated(TenantUser $user): void
    {
        //
    }

    /**
     * Handle the TenantUser "deleted" event.
     */
    public function deleted(TenantUser $user): void
    {
        // Soft delete the wallet when user is deleted
        if ($user->wallet) {
            $user->wallet->update(['is_active' => false]);
        }
    }

    /**
     * Handle the TenantUser "restored" event.
     */
    public function restored(TenantUser $user): void
    {
        // Reactivate wallet when user is restored
        if ($user->wallet) {
            $user->wallet->update(['is_active' => true]);
        }
    }

    /**
     * Handle the TenantUser "force deleted" event.
     */
    public function forceDeleted(TenantUser $user): void
    {
        //
    }
}
