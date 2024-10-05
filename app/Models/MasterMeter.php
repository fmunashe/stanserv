<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class MasterMeter extends Model
{
    use HasFactory;
    use SoftDeletes;
//    use \OwenIt\Auditing\Auditable;
    use HasUuids;

    protected $guarded = [];

    public function meterType(): BelongsTo
    {
        return $this->belongsTo(MeterType::class);
    }

    public function totaliserReading(): HasOne
    {
        return $this->hasOne(MasterMeterTotaliserReading::class);
    }

    public function meterCalibration(): BelongsTo
    {
        return $this->belongsTo(MeterCalibration::class);
    }
}
