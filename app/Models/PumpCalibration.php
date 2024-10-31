<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class PumpCalibration extends Model
{
    use HasFactory;
    use SoftDeletes;

//    use Auditable;
    use HasUuids;

    protected $guarded = [];

    public function pumpOwner(): BelongsTo
    {
        return $this->belongsTo(PumpOwner::class);
    }

    public function pumpDetail(): BelongsTo
    {
        return $this->belongsTo(PumpDetail::class);
    }

    public function totaliserReading(): HasMany
    {
        return $this->hasMany(PumpCalibrationTotaliserReading::class);
    }

    public function calibrationMeasureDetails(): HasMany
    {
        return $this->hasMany(PumpCalibrationMeasureDetail::class);
    }

    public function certificate(): HasOne
    {
        return $this->hasOne(Certificate::class);
    }

    public function calibrationProduct(): BelongsTo
    {
        return $this->belongsTo(CalibrationProduct::class);
    }

    public function calibrationStandards(): HasMany
    {
        return $this->hasMany(CalibrationStandard::class);
    }
}
