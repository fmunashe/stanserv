<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TruckOwnerDetail extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded =[];
    public function trucks(): HasMany
    {
        return $this->hasMany(TruckIdentification::class);
    }
}
