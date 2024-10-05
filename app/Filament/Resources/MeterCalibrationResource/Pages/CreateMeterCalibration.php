<?php

namespace App\Filament\Resources\MeterCalibrationResource\Pages;

use App\Filament\Resources\MeterCalibrationResource;
use App\Models\MeterCalibrationCertificate;
use Carbon\Carbon;
use Filament\Resources\Pages\CreateRecord;

class CreateMeterCalibration extends CreateRecord
{
    protected static string $resource = MeterCalibrationResource::class;

    protected function afterCreate(): void
    {
        $calibration = $this->getRecord();
        $certificate = MeterCalibrationCertificate::query()->latest()->first();
        if ($certificate == null) {
            $id = 1;
            $paddedId = str_pad($id, 3, '0', STR_PAD_LEFT);
            $certificateNumber = "83M-" . Carbon::now()->format('Y') ."-". $paddedId;
        } else {
            $id = $certificate->id + 1;
            $paddedId = str_pad($id, 3, '0', STR_PAD_LEFT);
            $certificateNumber = "83M-" . Carbon::now()->format('Y') . "-" . $paddedId;
        }
        MeterCalibrationCertificate::query()->create([
            'meter_calibration_id' => $calibration->id,
            'certificate_number' => $certificateNumber
        ]);
    }
}
