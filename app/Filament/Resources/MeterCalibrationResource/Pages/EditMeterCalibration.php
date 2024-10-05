<?php

namespace App\Filament\Resources\MeterCalibrationResource\Pages;

use App\Filament\Resources\MeterCalibrationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMeterCalibration extends EditRecord
{
    protected static string $resource = MeterCalibrationResource::class;

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
