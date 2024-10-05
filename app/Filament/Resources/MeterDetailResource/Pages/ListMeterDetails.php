<?php

namespace App\Filament\Resources\MeterDetailResource\Pages;

use App\Filament\Resources\MeterDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ListMeterDetails extends ListRecords
{
    protected static string $resource = MeterDetailResource::class;

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
