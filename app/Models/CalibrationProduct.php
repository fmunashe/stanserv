<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CalibrationProduct extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function pumpCalibrations(): HasMany
    {
        return $this->hasMany(PumpCalibration::class);
    }

    public function meterCalibration(): HasMany
    {
        return $this->hasMany(MeterCalibration::class);
    }
}
