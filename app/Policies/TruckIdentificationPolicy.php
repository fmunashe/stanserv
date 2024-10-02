<?php

namespace App\Policies;

use App\Models\TruckIdentification;
use App\Models\User;

class TruckIdentificationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'truck_identification_access');
        })->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TruckIdentification $truckIdentification): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'truck_identification_show');
        })->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'truck_identification_create');
        })->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TruckIdentification $truckIdentification): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'truck_identification_edit');
        })->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TruckIdentification $truckIdentification): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'truck_identification_delete');
        })->exists();
    }

    public function deleteAny(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'truck_identification_delete');
        })->exists();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TruckIdentification $truckIdentification): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'truck_identification_delete');
        })->exists();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TruckIdentification $truckIdentification): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'truck_identification_delete');
        })->exists();
    }
}
