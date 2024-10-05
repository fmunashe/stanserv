<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MeterCalibrationCertificateResource\Pages;
use App\Filament\Resources\MeterCalibrationCertificateResource\RelationManagers;
use App\Models\MeterCalibrationCertificate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class MeterCalibrationCertificateResource extends Resource
{
    protected static ?string $model = MeterCalibrationCertificate::class;
    protected static ?string $label = 'Meter Certificates';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('meter_calibration_id')
                    ->relationship('meterCalibration', 'id')
                    ->required(),
                Forms\Components\TextInput::make('certificate_number')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    /**
     * @throws \Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('meterCalibration.id')
                    ->searchable()
                    ->url(fn($record) => MeterCalibrationResource::getUrl('view', ['record' => $record->meter_calibration_id]))
                    ->badge(),
                Tables\Columns\TextColumn::make('certificate_number')
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
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
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
            'index' => Pages\ListMeterCalibrationCertificates::route('/'),
            'create' => Pages\CreateMeterCalibrationCertificate::route('/create'),
            'view' => Pages\ViewMeterCalibrationCertificate::route('/{record}'),
            'edit' => Pages\EditMeterCalibrationCertificate::route('/{record}/edit'),
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
