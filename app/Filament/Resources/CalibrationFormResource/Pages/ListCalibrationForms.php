<?php

namespace App\Filament\Resources\CalibrationFormResource\Pages;

use App\Filament\Resources\CalibrationFormResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCalibrationForms extends ListRecords
{
    protected static string $resource = CalibrationFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
