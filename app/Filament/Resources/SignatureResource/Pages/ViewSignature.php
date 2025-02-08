<?php

namespace App\Filament\Resources\SignatureResource\Pages;

use App\Filament\Resources\SignatureResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSignature extends ViewRecord
{
    protected static string $resource = SignatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
