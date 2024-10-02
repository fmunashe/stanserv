<?php

namespace App\Filament\Resources\PumpOwnerResource\Pages;

use App\Filament\Resources\PumpOwnerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPumpOwner extends EditRecord
{
    protected static string $resource = PumpOwnerResource::class;

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
