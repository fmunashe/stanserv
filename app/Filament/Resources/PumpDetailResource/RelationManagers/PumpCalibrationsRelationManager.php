<?php

namespace App\Filament\Resources\PumpDetailResource\RelationManagers;

use App\Filament\Resources\PumpCalibrationResource;
use App\Models\PumpCalibration;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class PumpCalibrationsRelationManager extends RelationManager
{
    protected static string $relationship = 'pumpCalibrations';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    /**
     * @throws \Exception
     */
    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->searchable()
                    ->sortable()
                    ->label('Calibration Reference')
                    ->url(fn(PumpCalibration $record): ?string => $record->id ? PumpCalibrationResource::getUrl('view', ['record' => $record->id]) : null)
                    ->badge(),
                Tables\Columns\TextColumn::make('calibration_date')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('next_date_of_calibration')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('calibrated_by')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
