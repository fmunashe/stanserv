<?php

namespace App\Filament\Resources\TruckOwnerDetailResource\Pages;

use App\Filament\Resources\TruckOwnerDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTruckOwnerDetail extends ViewRecord
{
    protected static string $resource = TruckOwnerDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
