<?php

namespace App\Filament\Resources\MeterCalibrationCertificateResource\Pages;

use App\Filament\Resources\MeterCalibrationCertificateResource;
use Filament\Resources\Pages\ListRecords;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ListMeterCalibrationCertificates extends ListRecords
{
    protected static string $resource = MeterCalibrationCertificateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->exports([
                    ExcelExport::make()
                        ->fromTable()
                        ->askForFilename()
                        ->askForWriterType()
                        ->withColumns([
                            Column::make('created_at'),
                            Column::make('updated_at'),
                        ])
                ]),
        ];
    }
}
