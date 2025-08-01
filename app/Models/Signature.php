<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Signature extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pumpCalibration(): BelongsTo
    {
       return $this->belongsTo(PumpCalibration::class);
    }
    public function meterCalibration(): BelongsTo
    {
       return $this->belongsTo(MeterCalibration::class);
    }
}
