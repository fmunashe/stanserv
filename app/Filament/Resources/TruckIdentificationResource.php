<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TruckIdentificationResource\Pages;
use App\Filament\Resources\TruckIdentificationResource\RelationManagers;
use App\Models\TruckIdentification;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\ViewRecord;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class TruckIdentificationResource extends Resource
{
    protected static ?string $model = TruckIdentification::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('truck_owner_detail_id')
                    ->label('Truck Owner')
                    ->searchable()
                    ->relationship('truckOwnerDetail', 'name')
                    ->preload()
                    ->optionsLimit(5)
                    ->required(),
                Forms\Components\TextInput::make('make')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('model')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('year')
                    ->required(),
                Forms\Components\TextInput::make('horse_chassis_number')
                    ->maxLength(255),
                Forms\Components\TextInput::make('engine_number')
                    ->maxLength(255),
                Forms\Components\TextInput::make('road_license_number')
                    ->maxLength(255),
                Forms\Components\TextInput::make('mileage')
                    ->numeric(),
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
                Forms\Components\TextInput::make('trailer_chassis_number')
                    ->maxLength(255),
                Forms\Components\TextInput::make('fore_coupling_height')
                    ->maxLength(255),
                Forms\Components\TextInput::make('aft_coupling_height')
                    ->maxLength(255),
                Forms\Components\TextInput::make('air_bags_checked_satisfactory')
                    ->maxLength(255),
                Forms\Components\Select::make('truck_suspension_type')
                    ->label('Truck Suspension Type')
                    ->required()
                    ->searchable()
                    ->options(TruckIdentification::TRUCK_SUSPENSION_TYPE_SELECT),
                Forms\Components\Select::make('air_bags_completely')
                    ->label('Air Bags Status')
                    ->searchable()
                    ->options(TruckIdentification::AIR_BAGS_COMPLETELY_SELECT),
                Forms\Components\Fieldset::make("Truck Owner Details")
                    ->schema([
                        Forms\Components\Select::make('truckOwnerDetail')
                            ->label('Name')
                            ->relationship('truckOwnerDetail', 'name')
                            ->searchable()
                            ->optionsLimit(5),
                        Forms\Components\Select::make('phone_number')
                            ->relationship('truckOwnerDetail', 'phone_number')
                            ->searchable(),
                        Forms\Components\Select::make('cell_number')
                            ->relationship('truckOwnerDetail', 'cell_number')
                            ->searchable(),
                        Forms\Components\Select::make('email')
                            ->relationship('truckOwnerDetail', 'email')
                            ->searchable(),
                        Forms\Components\Select::make('fax')
                            ->relationship('truckOwnerDetail', 'fax')
                            ->searchable(),
                        Forms\Components\Select::make('contact_person')
                            ->relationship('truckOwnerDetail', 'contact_person')
                            ->searchable(),
                        Forms\Components\Select::make('contact_person_phone')
                            ->relationship('truckOwnerDetail', 'contact_person_phone')
                            ->searchable(),
                        Forms\Components\Select::make('driver')
                            ->relationship('truckOwnerDetail', 'driver')
                            ->searchable(),
                        Forms\Components\Select::make('driver_phone')
                            ->relationship('truckOwnerDetail', 'driver_phone')
                            ->searchable(),
                        Forms\Components\Select::make('address')
                            ->relationship('truckOwnerDetail', 'address')
                            ->searchable()
                            ->columnSpanFull(),

                    ])
                    ->visible(fn($livewire) => $livewire instanceof ViewRecord)
                    ->columns(3)
            ])->columns(4);
    }

    /**
     * @throws \Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('truckOwnerDetail.name')
                    ->sortable()
                    ->searchable()
                    ->url(fn(TruckIdentification $record): ?string => $record->truckOwnerDetail ? TruckOwnerDetailResource::getUrl('view', ['record' => $record->truckOwnerDetail]) : null),
                Tables\Columns\TextColumn::make('make')
                    ->searchable(),
                Tables\Columns\TextColumn::make('model')
                    ->searchable(),
                Tables\Columns\TextColumn::make('year')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('horse_chassis_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('engine_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('road_license_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mileage')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type_of_truck'),
                Tables\Columns\TextColumn::make('trailer_chassis_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tank_shape'),
                Tables\Columns\TextColumn::make('fore_coupling_height')
                    ->searchable(),
                Tables\Columns\TextColumn::make('aft_coupling_height')
                    ->searchable(),
                Tables\Columns\TextColumn::make('air_bags_checked_satisfactory')
                    ->searchable(),
                Tables\Columns\TextColumn::make('truck_suspension_type'),
                Tables\Columns\TextColumn::make('air_bags_completely'),
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
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    ExportBulkAction::make()
                        ->exports([
                            ExcelExport::make()
                                ->askForFilename()
                                ->askForWriterType()
                        ])
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTruckIdentifications::route('/'),
            'create' => Pages\CreateTruckIdentification::route('/create'),
            'view' => Pages\ViewTruckIdentification::route('/{record}'),
            'edit' => Pages\EditTruckIdentification::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Truck Details';
    }
}
