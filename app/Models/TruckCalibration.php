<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TruckCalibration extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function truckOwner(): BelongsTo
    {
        return $this->belongsTo(TruckOwnerDetail::class);
    }

    public function truckIdentification(): BelongsTo
    {
        return $this->belongsTo(TruckIdentification::class);
    }
}
