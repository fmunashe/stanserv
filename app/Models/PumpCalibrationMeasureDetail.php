<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;

class PumpCalibrationMeasureDetail extends Model implements \OwenIt\Auditing\Contracts\Auditable
{
    use HasFactory;
    use Auditable;
    use SoftDeletes;

    protected $guarded = [];

    public function pumpCalibration(): BelongsTo
    {
        return $this->belongsTo(PumpCalibration::class);
    }
}
