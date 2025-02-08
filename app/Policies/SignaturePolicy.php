<?php

namespace App\Policies;

use App\Models\Signature;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SignaturePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'signature_access');
        })->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Signature $signature): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'signature_show');
        })->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'signature_create');
        })->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Signature $signature): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'signature_edit');
        })->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Signature $signature): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'signature_delete');
        })->exists();
    }
    public function deleteAny(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'signature_delete');
        })->exists();
    }
    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Signature $signature): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'signature_delete');
        })->exists();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Signature $signature): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'signature_delete');
        })->exists();
    }
}
