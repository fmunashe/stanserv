<?php

namespace App\Filament\Resources\MeterOwnerResource\Pages;

use App\Filament\Resources\MeterOwnerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMeterOwner extends EditRecord
{
    protected static string $resource = MeterOwnerResource::class;

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
