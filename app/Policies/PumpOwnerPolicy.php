<?php

namespace App\Policies;

use App\Models\PumpOwner;
use App\Models\User;

class PumpOwnerPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'pump_owner_access');
        })->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PumpOwner $pumpOwner): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'pump_owner_show');
        })->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'pump_owner_create');
        })->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PumpOwner $pumpOwner): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'pump_owner_edit');
        })->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PumpOwner $pumpOwner): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'pump_owner_delete');
        })->exists();
    }

    public function deleteAny(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'pump_owner_delete');
        })->exists();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PumpOwner $pumpOwner): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'pump_owner_delete');
        })->exists();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PumpOwner $pumpOwner): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'pump_owner_delete');
        })->exists();
    }
}
