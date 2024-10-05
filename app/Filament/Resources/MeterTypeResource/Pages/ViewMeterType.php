<?php

namespace App\Filament\Resources\MeterTypeResource\Pages;

use App\Filament\Resources\MeterTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMeterType extends ViewRecord
{
    protected static string $resource = MeterTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
