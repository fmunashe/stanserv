<?php

namespace App\Policies;

use App\Models\CalibrationProduct;
use App\Models\User;

class CalibrationProductPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'calibration_product_access');
        })->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, CalibrationProduct $calibrationProduct): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'calibration_product_show');
        })->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'calibration_product_create');
        })->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CalibrationProduct $calibrationProduct): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'calibration_product_edit');
        })->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CalibrationProduct $calibrationProduct): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'calibration_product_delete');
        })->exists();
    }

    public function deleteAny(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'calibration_product_delete');
        })->exists();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, CalibrationProduct $calibrationProduct): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'calibration_product_delete');
        })->exists();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CalibrationProduct $calibrationProduct): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'calibration_product_delete');
        })->exists();
    }
}
