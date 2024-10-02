<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Volume;

class VolumePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'volume_access');
        })->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Volume $volume): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'volume_show');
        })->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'volume_create');
        })->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Volume $volume): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'volume_edit');
        })->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Volume $volume): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'volume_delete');
        })->exists();
    }

    public function deleteAny(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'volume_delete');
        })->exists();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Volume $volume): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'volume_delete');
        })->exists();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Volume $volume): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'volume_delete');
        })->exists();
    }
}
