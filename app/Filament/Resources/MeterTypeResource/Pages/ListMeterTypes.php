<?php

namespace App\Filament\Resources\MeterTypeResource\Pages;

use App\Filament\Resources\MeterTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ListMeterTypes extends ListRecords
{
    protected static string $resource = MeterTypeResource::class;

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
