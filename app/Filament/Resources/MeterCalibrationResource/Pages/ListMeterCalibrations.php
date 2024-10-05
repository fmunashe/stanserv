<?php

namespace App\Filament\Resources\MeterCalibrationResource\Pages;

use App\Filament\Resources\MeterCalibrationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ListMeterCalibrations extends ListRecords
{
    protected static string $resource = MeterCalibrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ExportAction::make()
                ->exports([
                    ExcelExport::make()
                        ->fromTable()
                        ->askForFilename()
                        ->askForWriterType()
                ]),
        ];
    }
}
