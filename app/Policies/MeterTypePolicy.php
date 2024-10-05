<?php

namespace App\Policies;

use App\Models\MeterType;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MeterTypePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'meter_type_access');
        })->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, MeterType $meterType): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'meter_type_show');
        })->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'meter_type_create');
        })->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, MeterType $meterType): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'meter_type_edit');
        })->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MeterType $meterType): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'meter_type_delete');
        })->exists();
    }

    public function deleteAny(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'meter_type_delete');
        })->exists();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, MeterType $meterType): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'meter_type_delete');
        })->exists();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, MeterType $meterType): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'meter_type_delete');
        })->exists();
    }
}
