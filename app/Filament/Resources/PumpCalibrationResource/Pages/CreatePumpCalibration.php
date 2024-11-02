<?php

namespace App\Filament\Resources\PumpCalibrationResource\Pages;

use App\Filament\Resources\PumpCalibrationResource;
use App\Models\Certificate;
use Carbon\Carbon;
use Filament\Resources\Pages\CreateRecord;

class CreatePumpCalibration extends CreateRecord
{
    protected static string $resource = PumpCalibrationResource::class;

    protected function afterCreate(): void
    {
        $calibration = $this->getRecord();
        $certificate = Certificate::query()->latest()->first();
        if ($certificate == null) {
            $id = 1;
            $paddedId = str_pad($id, 3, '0', STR_PAD_LEFT);
            $certificateNumber = "83P-" . Carbon::now()->format('Y') . "-" . $paddedId;
        } else {
            $id = $certificate->id + 1;
            $paddedId = str_pad($id, 3, '0', STR_PAD_LEFT);
            $certificateNumber = "83P-" . Carbon::now()->format('Y') . "-" . $paddedId;
        }
        Certificate::query()->create([
            'pump_calibration_id' => $calibration->id,
            'certificate_number' => $certificateNumber
        ]);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('edit', ['record' => $this->getRecord()]);
    }
}
