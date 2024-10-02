<?php

namespace App\Filament\Resources\TruckOwnerDetailResource\Pages;

use App\Filament\Resources\TruckOwnerDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTruckOwnerDetail extends EditRecord
{
    protected static string $resource = TruckOwnerDetailResource::class;

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
