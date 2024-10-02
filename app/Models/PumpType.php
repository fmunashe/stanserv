<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;

class PumpType extends Model implements \OwenIt\Auditing\Contracts\Auditable
{
    use HasFactory;
    use SoftDeletes;
    use Auditable;

    protected $guarded = [];

    public function pumpDetails(): HasMany
    {
        return $this->hasMany(PumpDetail::class);
    }
}
