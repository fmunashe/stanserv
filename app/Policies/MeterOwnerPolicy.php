<?php

namespace App\Policies;

use App\Models\MeterOwner;
use App\Models\User;

class MeterOwnerPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'meter_owner_access');
        })->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, MeterOwner $meterOwner): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'meter_owner_show');
        })->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'meter_owner_create');
        })->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, MeterOwner $meterOwner): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'meter_owner_edit');
        })->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MeterOwner $meterOwner): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'meter_owner_delete');
        })->exists();
    }

    public function deleteAny(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'meter_owner_delete');
        })->exists();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, MeterOwner $meterOwner): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'meter_owner_delete');
        })->exists();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, MeterOwner $meterOwner): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'meter_owner_delete');
        })->exists();
    }
}