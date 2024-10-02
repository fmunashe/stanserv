<?php

namespace App\Filament\Resources\CompartmentResource\Pages;

use App\Filament\Resources\CompartmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompartment extends EditRecord
{
    protected static string $resource = CompartmentResource::class;

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
