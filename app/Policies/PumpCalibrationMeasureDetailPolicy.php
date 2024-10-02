<?php

namespace App\Policies;

use App\Models\PumpCalibrationMeasureDetail;
use App\Models\User;

class PumpCalibrationMeasureDetailPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'pump_calibration_measure_detail_access');
        })->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PumpCalibrationMeasureDetail $pumpCalibrationMeasureDetail): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'pump_calibration_measure_detail_show');
        })->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'pump_calibration_measure_detail_create');
        })->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PumpCalibrationMeasureDetail $pumpCalibrationMeasureDetail): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'pump_calibration_measure_detail_edit');
        })->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PumpCalibrationMeasureDetail $pumpCalibrationMeasureDetail): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'pump_calibration_measure_detail_delete');
        })->exists();
    }

    public function deleteAny(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'pump_calibration_measure_detail_delete');
        })->exists();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PumpCalibrationMeasureDetail $pumpCalibrationMeasureDetail): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'pump_calibration_measure_detail_delete');
        })->exists();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PumpCalibrationMeasureDetail $pumpCalibrationMeasureDetail): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'pump_calibration_measure_detail_delete');
        })->exists();
    }
}
