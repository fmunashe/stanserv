<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certificate extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function calibration(): BelongsTo
    {
        return $this->belongsTo(PumpCalibration::class);
    }
}
