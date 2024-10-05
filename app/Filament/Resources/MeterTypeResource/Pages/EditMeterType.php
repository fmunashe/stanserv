<?php

namespace App\Filament\Resources\MeterTypeResource\Pages;

use App\Filament\Resources\MeterTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMeterType extends EditRecord
{
    protected static string $resource = MeterTypeResource::class;

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
