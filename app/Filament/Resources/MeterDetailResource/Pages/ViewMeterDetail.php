<?php

namespace App\Filament\Resources\MeterDetailResource\Pages;

use App\Filament\Resources\MeterDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMeterDetail extends ViewRecord
{
    protected static string $resource = MeterDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
