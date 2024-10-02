<?php

namespace App\Filament\Resources\TruckOwnerDetailResource\RelationManagers;

use App\Filament\Resources\TruckOwnerDetailResource;
use App\Models\TruckIdentification;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class TrucksRelationManager extends RelationManager
{
    protected static string $relationship = 'trucks';

    public function form(Form $form): Form
    {
        return $form
            ->columns(3)
            ->schema([
                Forms\Components\TextInput::make('engine_number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('make')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('model')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('year')
                    ->required(),
                Forms\Components\TextInput::make('horse_chassis_number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('trailer_chassis_number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('road_license_number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('mileage')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->maxLength(255),
                Forms\Components\Select::make('type_of_truck')
                    ->label('Truck Type')
                    ->required()
                    ->searchable()
                    ->options(TruckIdentification::TRUCK_TYPE_SELECT),
                Forms\Components\Select::make('tank_shape')
                    ->label('Tank Shape')
                    ->required()
                    ->searchable()
                    ->options(TruckIdentification::TANK_SHAPE_SELECT),
                Forms\Components\TextInput::make('fore_coupling_height')
                    ->label('Fore Coupling Height')
                    ->required(),
                Forms\Components\TextInput::make('aft_coupling_height')
                    ->label('AFT Coupling Height')
                    ->required(),
                Forms\Components\TextInput::make('air_bags_checked_satisfactory')
                    ->label('Air Bags Checked Satisfactory'),
                Forms\Components\Select::make('truck_suspension_type')
                    ->label('Truck Suspension Type')
                    ->required()
                    ->searchable()
                    ->options(TruckIdentification::TRUCK_SUSPENSION_TYPE_SELECT),
                Forms\Components\Select::make('air_bags_completely')
                    ->label('Air Bags Status')
                    ->searchable()
                    ->options(TruckIdentification::AIR_BAGS_COMPLETELY_SELECT),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('engine_number')
            ->columns([
                Tables\Columns\TextColumn::make('truckOwnerDetail.name')
                    ->sortable()
                    ->searchable()
                    ->url(fn(TruckIdentification $record): ?string => $record->truckOwnerDetail ? TruckOwnerDetailResource::getUrl('view', ['record' => $record->truckOwnerDetail]) : null),
                Tables\Columns\TextColumn::make('make')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('model')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('year')
                    ->date()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('horse_chassis_number')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('engine_number')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('road_license_number')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('mileage')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('type_of_truck')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('trailer_chassis_number')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('tank_shape')
                    ->toggleable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('fore_coupling_height')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('aft_coupling_height')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('air_bags_checked_satisfactory')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('truck_suspension_type')
                    ->toggleable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('air_bags_completely')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Add New Truck')
                    ->modalWidth('7xl')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DissociateBulkAction::make(),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
