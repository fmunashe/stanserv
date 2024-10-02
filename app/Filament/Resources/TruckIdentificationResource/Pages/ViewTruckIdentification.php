<?php

namespace App\Filament\Resources\TruckIdentificationResource\Pages;

use App\Filament\Resources\TruckIdentificationResource;
use Filament\Actions;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ViewRecord;

class ViewTruckIdentification extends ViewRecord
{
    protected static string $resource = TruckIdentificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('Truck Owner Details')
                ->schema([
                    TextInput::make('truckOwnerDetail.name')
                        ->label('Owner Name')
                        ->disabled(),
                ])
                ->columns(2),
        ];
    }
}
