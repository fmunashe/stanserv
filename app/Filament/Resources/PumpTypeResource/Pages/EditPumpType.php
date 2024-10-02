<?php

namespace App\Filament\Resources\PumpTypeResource\Pages;

use App\Filament\Resources\PumpTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPumpType extends EditRecord
{
    protected static string $resource = PumpTypeResource::class;

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
