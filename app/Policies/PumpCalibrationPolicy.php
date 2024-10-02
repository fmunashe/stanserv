<?php

namespace App\Policies;

use App\Models\PumpCalibration;
use App\Models\User;

class PumpCalibrationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'pump_calibration_access');
        })->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PumpCalibration $pumpCalibration): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'pump_calibration_show');
        })->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'pump_calibration_create');
        })->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PumpCalibration $pumpCalibration): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'pump_calibration_edit');
        })->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PumpCalibration $pumpCalibration): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'pump_calibration_delete');
        })->exists();
    }

    public function deleteAny(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'pump_calibration_delete');
        })->exists();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PumpCalibration $pumpCalibration): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'pump_calibration_delete');
        })->exists();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PumpCalibration $pumpCalibration): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'pump_calibration_delete');
        })->exists();
    }
}
