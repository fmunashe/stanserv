<?php

namespace App\Filament\Resources\TruckIdentificationResource\Pages;

use App\Filament\Resources\TruckIdentificationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTruckIdentification extends EditRecord
{
    protected static string $resource = TruckIdentificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
