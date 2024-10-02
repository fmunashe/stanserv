<?php

namespace App\Filament\Resources\PumpOwnerResource\Pages;

use App\Filament\Resources\PumpOwnerResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPumpOwner extends ViewRecord
{
    protected static string $resource = PumpOwnerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
