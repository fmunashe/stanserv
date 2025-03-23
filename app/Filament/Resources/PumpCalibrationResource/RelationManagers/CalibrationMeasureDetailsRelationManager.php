<?php

namespace App\Filament\Resources\PumpCalibrationResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class CalibrationMeasureDetailsRelationManager extends RelationManager
{
    protected static string $relationship = 'calibrationMeasureDetails';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('corrected_volume')
                    ->required()
                    ->numeric()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $get, callable $set) {
                        if ($get('pump_under_test_volume')
                            && $get('corrected_volume')
                        ) {
                            $set('difference', number_format($get('corrected_volume') - $get('pump_under_test_volume'), 4, '.', ''));
                        } else {
                            $set('difference', 0.00);
                        }
                    }),
                Forms\Components\TextInput::make('pump_under_test_volume')
                    ->required()
                    ->numeric()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $get, callable $set) {
                        if ($get('pump_under_test_volume')
                            && $get('corrected_volume')
                        ) {
                            $set('difference',  number_format($get('corrected_volume') - $get('pump_under_test_volume'), 4, '.', ''));
                        } else {
                            $set('difference', 0.00);
                        }
                    }),
                Forms\Components\TextInput::make('difference')
                    ->required()
                    ->numeric()
                    ->readOnly(),
                Forms\Components\Textarea::make('corrective_action')
                    ->maxLength(225)
                    ->columnSpanFull(),
            ])
            ->columns(3);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('corrected_volume'),
                Tables\Columns\TextColumn::make('pump_under_test_volume'),
                Tables\Columns\TextColumn::make('difference'),
                Tables\Columns\TextColumn::make('percentage_error'),
                Tables\Columns\TextColumn::make('corrective_action')
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make()
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label("New Calibration / Assize Runs")
                    ->modalWidth('5xl')
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['percentage_error'] = number_format((($data['corrected_volume'] - $data['pump_under_test_volume']) / ($data['corrected_volume'])) * 100, 3, '.', '');
                        return $data;
                    }),
                ExportAction::make()
                    ->exports([
                        ExcelExport::make()
                            ->fromTable()
                            ->askForFilename()
                            ->askForWriterType()
                            ->withColumns([
                                Column::make('created_at'),
                                Column::make('updated_at'),
                            ])
                    ]),
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
                ]),
            ])
            ->modifyQueryUsing(fn(Builder $query) => $query->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]));
    }
    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('Calibration / Assize Runs');
    }
}
