<?php

namespace App\Filament\Resources\MeterOwnerResource\Pages;

use App\Filament\Resources\MeterOwnerResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMeterOwner extends ViewRecord
{
    protected static string $resource = MeterOwnerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
