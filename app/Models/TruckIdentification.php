<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TruckIdentification extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public const TRUCK_TYPE_SELECT = [
        'Rigid' => 'Rigid',
        'Articulated' => 'Articulated',
    ];
    public const TANK_SHAPE_SELECT = [
        'Round' => 'Round',
        'Oval' => 'Oval',
    ];
    public const TRUCK_SUSPENSION_TYPE_SELECT = [
        'Springs' => 'Springs',
        'Air Bags' => 'Air Bags',
    ];
    public const AIR_BAGS_COMPLETELY_SELECT = [
        'Full' => 'Full',
        'Empty' => 'Empty',
    ];

    public function truckOwnerDetail(): BelongsTo
    {
        return $this->belongsTo(TruckOwnerDetail::class);
    }
}
