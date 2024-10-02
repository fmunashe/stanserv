<?php

namespace App\Filament\Resources\CompartmentResource\Pages;

use App\Filament\Resources\CompartmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCompartment extends ViewRecord
{
    protected static string $resource = CompartmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
