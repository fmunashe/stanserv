<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class MeterCalibrationCertificate extends Model
{
    use HasFactory;
    use SoftDeletes;

    use HasUuids;

    protected $guarded = [];

    public function meterCalibration(): BelongsTo
    {
        return $this->belongsTo(MeterCalibration::class);
    }
}
