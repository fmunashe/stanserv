<?php

namespace App\Filament\Resources\PumpTypeResource\Pages;

use App\Filament\Resources\PumpTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPumpType extends ViewRecord
{
    protected static string $resource = PumpTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
