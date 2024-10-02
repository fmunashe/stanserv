<?php

namespace App\Policies;

use App\Models\TruckOwnerDetail;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TruckOwnerDetailPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'truck_owner_access');
        })->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TruckOwnerDetail $truckOwnerDetail): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'truck_owner_show');
        })->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'truck_owner_create');
        })->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TruckOwnerDetail $truckOwnerDetail): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'truck_owner_edit');
        })->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TruckOwnerDetail $truckOwnerDetail): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'truck_owner_delete');
        })->exists();
    }
    public function deleteAny(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'truck_owner_delete');
        })->exists();
    }
    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TruckOwnerDetail $truckOwnerDetail): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'truck_owner_delete');
        })->exists();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TruckOwnerDetail $truckOwnerDetail): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'truck_owner_delete');
        })->exists();
    }
}
