<?php

namespace App\Policies;

use App\Models\MeterDetail;
use App\Models\User;

class MeterDetailPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'meter_detail_access');
        })->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, MeterDetail $meterDetail): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'meter_detail_show');
        })->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'meter_detail_create');
        })->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, MeterDetail $meterDetail): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'meter_detail_edit');
        })->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MeterDetail $meterDetail): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'meter_detail_delete');
        })->exists();
    }

    public function deleteAny(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'meter_detail_delete');
        })->exists();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, MeterDetail $meterDetail): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'meter_detail_delete');
        })->exists();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, MeterDetail $meterDetail): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'meter_detail_delete');
        })->exists();
    }
}
