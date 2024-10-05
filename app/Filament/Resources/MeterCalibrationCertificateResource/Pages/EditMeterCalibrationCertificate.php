<?php

namespace App\Filament\Resources\MeterCalibrationCertificateResource\Pages;

use App\Filament\Resources\MeterCalibrationCertificateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMeterCalibrationCertificate extends EditRecord
{
    protected static string $resource = MeterCalibrationCertificateResource::class;

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
