<?php

namespace App\Policies;

use App\Models\MeterCalibrationTotaliserReading;
use App\Models\User;

class MeterCalibrationTotaliserReadingPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'meter_calibration_totaliser_reading_access');
        })->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, MeterCalibrationTotaliserReading $meterCalibrationTotaliserReading): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'meter_calibration_totaliser_reading_show');
        })->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'meter_calibration_totaliser_reading_create');
        })->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, MeterCalibrationTotaliserReading $meterCalibrationTotaliserReading): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'meter_calibration_totaliser_reading_edit');
        })->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MeterCalibrationTotaliserReading $meterCalibrationTotaliserReading): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'meter_calibration_totaliser_reading_delete');
        })->exists();
    }

    public function deleteAny(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'meter_calibration_totaliser_reading_delete');
        })->exists();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, MeterCalibrationTotaliserReading $meterCalibrationTotaliserReading): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'meter_calibration_totaliser_reading_delete');
        })->exists();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, MeterCalibrationTotaliserReading $meterCalibrationTotaliserReading): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'meter_calibration_totaliser_reading_delete');
        })->exists();
    }
}
