<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MeterDetail extends Model
{
    use HasFactory;
    use SoftDeletes;


    use HasUuids;

    protected $guarded = [];

    public function meterType(): BelongsTo
    {
        return $this->belongsTo(MeterType::class);
    }

    public function meterOwner(): BelongsTo
    {
        return $this->belongsTo(MeterOwner::class);
    }

    public function meterCalibrations(): HasMany
    {
        return $this->hasMany(MeterCalibration::class);
    }
}
