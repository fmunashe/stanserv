<?php

namespace App\Filament\Resources\MeterCalibrationCertificateResource\Pages;

use App\Filament\Resources\MeterCalibrationCertificateResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMeterCalibrationCertificate extends ViewRecord
{
    protected static string $resource = MeterCalibrationCertificateResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\EditAction::make(),
        ];
    }
}
