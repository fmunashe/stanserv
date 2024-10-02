<?php

namespace App\Filament\Resources\PumpDetailResource\Pages;

use App\Filament\Resources\PumpDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPumpDetail extends EditRecord
{
    protected static string $resource = PumpDetailResource::class;

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
