<?php

namespace App\Filament\Resources\PumpDetailResource\Pages;

use App\Filament\Resources\PumpDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPumpDetail extends ViewRecord
{
    protected static string $resource = PumpDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
