<?php

namespace App\Filament\Resources\MeterDetailResource\Pages;

use App\Filament\Resources\MeterDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMeterDetail extends EditRecord
{
    protected static string $resource = MeterDetailResource::class;

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
