<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MeterDetailResource\Pages;
use App\Filament\Resources\MeterDetailResource\RelationManagers;
use App\Models\MeterDetail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class MeterDetailResource extends Resource
{
    protected static ?string $model = MeterDetail::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('meter_owner_id')
                    ->label('Meter Owner')
                    ->relationship('meterOwner', 'company_name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('company_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('contact_person')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('contact_person_phone')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('contact_person_email')
                            ->email()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('address')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ]),
                Forms\Components\Select::make('meter_type_id')
                    ->label('Meter Type')
                    ->relationship('meterType', 'meter_type')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('meter_type')
                            ->label('Meter Type')
                            ->required()
                            ->maxLength(255)
                            ->unique('meter_types', 'meter_type', ignoreRecord: true),
                        Forms\Components\TextInput::make('description')
                            ->maxLength(255),
                    ]),
                Forms\Components\TextInput::make('location')
                    ->maxLength(255)
                    ->required(),
                Forms\Components\TextInput::make('model')
                    ->maxLength(255)
                    ->required(),
                Forms\Components\TextInput::make('serial_number')
                    ->maxLength(255)
                    ->required(),
                Forms\Components\TextInput::make('flow_rate')
                    ->maxLength(255)
                    ->required(),
                Forms\Components\TextInput::make('meter_resolution')
                    ->maxLength(255)
                    ->required(),
            ]);
    }

    /**
     * @throws \Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('meterOwner.company_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('meterType.meter_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('model')
                    ->searchable(),
                Tables\Columns\TextColumn::make('serial_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('flow_rate')
                    ->searchable(),
                Tables\Columns\TextColumn::make('meter_resolution')
                    ->searchable(),
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
            'index' => Pages\ListMeterDetails::route('/'),
            'create' => Pages\CreateMeterDetail::route('/create'),
            'view' => Pages\ViewMeterDetail::route('/{record}'),
            'edit' => Pages\EditMeterDetail::route('/{record}/edit'),
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
        return 'Meters';
    }
}
