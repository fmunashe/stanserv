<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class MeterCalibration extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUuids;

    protected $guarded = [];

    public function masterMeter(): HasOne
    {
        return $this->hasOne(MasterMeter::class);
    }

    public function meterDetail(): BelongsTo
    {
        return $this->belongsTo(MeterDetail::class);
    }

    public function meterOwner(): BelongsTo
    {
        return $this->belongsTo(MeterOwner::class);
    }

    public function totaliserReading(): HasOne
    {
        return $this->hasOne(MeterCalibrationTotaliserReading::class);
    }

    public function calibrationMeasureDetails(): HasMany
    {
        return $this->hasMany(MeterCalibrationMeasureDetail::class);
    }

    public function certificate(): HasOne
    {
        return $this->hasOne(MeterCalibrationCertificate::class);
    }
    public function userSignature(): BelongsTo
    {
        return $this->belongsTo(Signature::class,'signature_id','id');
    }
}
