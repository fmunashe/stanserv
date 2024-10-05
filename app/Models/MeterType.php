<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MeterType extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUuids;

    protected $guarded = [];

    public function meterDetails(): HasMany
    {
        return $this->hasMany(MeterDetail::class);
    }

    public function masterMeters(): HasMany
    {
        return $this->hasMany(MasterMeter::class);
    }
}
