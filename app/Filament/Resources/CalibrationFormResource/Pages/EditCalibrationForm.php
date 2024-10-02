<?php

namespace App\Filament\Resources\CalibrationFormResource\Pages;

use App\Filament\Resources\CalibrationFormResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCalibrationForm extends EditRecord
{
    protected static string $resource = CalibrationFormResource::class;

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
