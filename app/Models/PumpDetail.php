<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;

class PumpDetail extends Model implements \OwenIt\Auditing\Contracts\Auditable
{
    use HasFactory;
    use SoftDeletes;
    use Auditable;

    protected $guarded = [];

    public function pumpOwner(): BelongsTo
    {
        return $this->belongsTo(PumpOwner::class);
    }

    public function pumpType(): BelongsTo
    {
        return $this->belongsTo(PumpType::class);
    }

    public function pumpCalibrations(): HasMany
    {
        return $this->hasMany(PumpCalibration::class);
    }
}
