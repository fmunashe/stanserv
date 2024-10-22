<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PumpDetailResource\Pages;
use App\Filament\Resources\PumpDetailResource\RelationManagers;
use App\Models\PumpDetail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Tapp\FilamentAuditing\RelationManagers\AuditsRelationManager;

class PumpDetailResource extends Resource
{
    protected static ?string $model = PumpDetail::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('pump_owner_id')
                    ->relationship('pumpOwner', 'company_name')
                    ->searchable()
                    ->preload()
                    ->optionsLimit(5)
                    ->required(),
                Forms\Components\Select::make('pump_type_id')
                    ->relationship('pumpType', 'pump_type')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('mode')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->options([
                        'Commercial' => 'Commercial',
                        'Retail' => 'Retail'
                    ]),
                Forms\Components\TextInput::make('location')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('model')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('serial_number')
                    ->required()
                    ->unique('pump_details', 'serial_number', ignoreRecord: true)
                    ->maxLength(255),
                Forms\Components\TextInput::make('flow_rate')
                    ->label('Flow Rate LPM (Litre Per Minute)')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pumpOwner.company_name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('pumpType.pump_type')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('model')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mode')
                    ->searchable(),
                Tables\Columns\TextColumn::make('serial_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('flow_rate')
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
            RelationManagers\PumpCalibrationsRelationManager::class,
            AuditsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPumpDetails::route('/'),
            'create' => Pages\CreatePumpDetail::route('/create'),
            'view' => Pages\ViewPumpDetail::route('/{record}'),
            'edit' => Pages\EditPumpDetail::route('/{record}/edit'),
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
        return 'Pumps';
    }
}
