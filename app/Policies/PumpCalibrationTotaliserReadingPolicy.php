<?php

namespace App\Policies;

use App\Models\PumpCalibrationTotaliserReading;
use App\Models\User;

class PumpCalibrationTotaliserReadingPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'pump_calibration_totaliser_reading_access');
        })->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PumpCalibrationTotaliserReading $pumpCalibrationTotaliserReading): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'pump_calibration_totaliser_reading_show');
        })->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'pump_calibration_totaliser_reading_create');
        })->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PumpCalibrationTotaliserReading $pumpCalibrationTotaliserReading): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'pump_calibration_totaliser_reading_edit');
        })->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PumpCalibrationTotaliserReading $pumpCalibrationTotaliserReading): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'pump_calibration_totaliser_reading_delete');
        })->exists();
    }

    public function deleteAny(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'pump_calibration_totaliser_reading_delete');
        })->exists();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PumpCalibrationTotaliserReading $pumpCalibrationTotaliserReading): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'pump_calibration_totaliser_reading_delete');
        })->exists();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PumpCalibrationTotaliserReading $pumpCalibrationTotaliserReading): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'pump_calibration_totaliser_reading_delete');
        })->exists();
    }
}
