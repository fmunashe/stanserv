<?php

namespace App\Policies;

use App\Models\CalibrationStandard;
use App\Models\User;

class CalibrationStandardPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'calibration_standard_access');
        })->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, CalibrationStandard $calibrationStandard): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'calibration_standard_show');
        })->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'calibration_standard_create');
        })->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CalibrationStandard $calibrationStandard): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'calibration_standard_edit');
        })->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CalibrationStandard $calibrationStandard): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'calibration_standard_delete');
        })->exists();
    }

    public function deleteAny(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'calibration_standard_delete');
        })->exists();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, CalibrationStandard $calibrationStandard): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'calibration_standard_delete');
        })->exists();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CalibrationStandard $calibrationStandard): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'calibration_standard_delete');
        })->exists();
    }
}
