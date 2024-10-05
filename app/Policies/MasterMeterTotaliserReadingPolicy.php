<?php

namespace App\Policies;

use App\Models\MasterMeterTotaliserReading;
use App\Models\User;

class MasterMeterTotaliserReadingPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'master_meter_totaliser_reading_access');
        })->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, MasterMeterTotaliserReading $masterMeterTotaliserReading): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'master_meter_totaliser_reading_show');
        })->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'master_meter_totaliser_reading_create');
        })->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, MasterMeterTotaliserReading $masterMeterTotaliserReading): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'master_meter_totaliser_reading_edit');
        })->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MasterMeterTotaliserReading $masterMeterTotaliserReading): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'master_meter_totaliser_reading_delete');
        })->exists();
    }

    public function deleteAny(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'master_meter_totaliser_reading_delete');
        })->exists();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, MasterMeterTotaliserReading $masterMeterTotaliserReading): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'master_meter_totaliser_reading_delete');
        })->exists();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, MasterMeterTotaliserReading $masterMeterTotaliserReading): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'master_meter_totaliser_reading_delete');
        })->exists();
    }
}
