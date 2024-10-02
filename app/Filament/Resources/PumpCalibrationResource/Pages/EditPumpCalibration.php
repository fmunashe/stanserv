<?php

namespace App\Filament\Resources\PumpCalibrationResource\Pages;

use App\Filament\Resources\PumpCalibrationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPumpCalibration extends EditRecord
{
    protected static string $resource = PumpCalibrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }

//    public function hasCombinedRelationManagerTabsWithContent(): bool
//    {
//        return true;
//    }
//    public function getContentTabIcon(): ?string
//    {
//        return 'heroicon-m-cog';
//    }
}
