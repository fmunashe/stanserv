<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PumpCalibrationStatus extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function pumpCalibration(): HasMany
    {
        return$this->hasMany(PumpCalibration::class);

    }
}
