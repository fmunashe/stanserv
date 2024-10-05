<?php

namespace App\Filament\Resources\MeterCalibrationResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
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
                Forms\Components\TextInput::make('run_number')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->live()
                    ->afterStateUpdated(function ($state, callable $get, callable $set) {
                        if ($get('run_number') == 1) {
                            $set('remarks', 'Wetting run');
                        } else {
                            $set('remarks', 'Adjusted');
                        }
                    }),
                Forms\Components\TextInput::make('master_meter_flow_rate')
                    ->label('Master Meter Flow Rate (LPM)')
                    ->required(),
                Forms\Components\TextInput::make('master_meter_temperature')
                    ->label('Master Meter Temperature')
                    ->required(),
                Forms\Components\TextInput::make('master_meter_pressure')
                    ->label('Master Meter Pressure (Bars)')
                    ->required(),
                Forms\Components\TextInput::make('master_meter_volume')
                    ->label('Master Meter Volume (Ltrs)')
                    ->required()
                    ->live()
                    ->afterStateUpdated(function ($state, callable $get, callable $set) {
                        if ($get('master_meter_volume') && $get('line_meter_volume')
                        ) {
                            $set('difference', number_format($get('master_meter_volume') - $get('line_meter_volume'), 1, '.', ''));
                            $set('meter_factor', number_format($get('master_meter_volume') / $get('line_meter_volume'), 5, '.', ''));
                            $set('percentage_error', number_format((($get('master_meter_volume') - $get('line_meter_volume')) / $get('master_meter_volume')) * 100, 4, '.', ''));
                        } else {
                            $set('difference', 0.00);
                            $set('meter_factor', 0.00);
                            $set('percentage_error', 0.00);
                        }
                    }),
                Forms\Components\TextInput::make('line_meter_volume')
                    ->label('Line Meter Volume')
                    ->required()
                    ->live()
                    ->afterStateUpdated(function ($state, callable $get, callable $set) {
                        if ($get('master_meter_volume') && $get('line_meter_volume')
                        ) {
                            $set('difference', number_format($get('master_meter_volume') - $get('line_meter_volume'), 1, '.', ''));
                            $set('meter_factor', number_format($get('master_meter_volume') / $get('line_meter_volume'), 5, '.', ''));
                            $set('percentage_error', number_format((($get('master_meter_volume') - $get('line_meter_volume')) / $get('master_meter_volume')) * 100, 3, '.', ''));
                        } else {
                            $set('difference', 0.00);
                            $set('meter_factor', 0.00);
                            $set('percentage_error', 0.00);
                        }
                    }),
                Forms\Components\TextInput::make('difference')
                    ->label('difference')
                    ->required()
                    ->readOnly()
                    ->live()
                    ->visible(fn($record, $get) => $get('run_number') > 1)
                    ->required(fn($record, $get) => $get('run_number') > 1),
                Forms\Components\TextInput::make('meter_factor')
                    ->label('Meter Factor')
                    ->required()
                    ->readOnly()
                    ->live()
                    ->visible(fn($record, $get) => $get('run_number') > 1)
                    ->required(fn($record, $get) => $get('run_number') > 1),
                Forms\Components\TextInput::make('percentage_error')
                    ->label('Percentage Error')
                    ->required()
                    ->readOnly()
                    ->live()
                    ->visible(fn($record, $get) => $get('run_number') > 1)
                    ->required(fn($record, $get) => $get('run_number') > 1),
                Forms\Components\Select::make('remarks')
                    ->label('Remarks')
                    ->searchable()
                    ->options([
                        'Wetting Run' => 'Wetting Run',
                        'Adjusted' => 'Adjusted'
                    ])
                    ->required()
                    ->columnSpanFull()
                    ->live(),
            ])
            ->columns(3);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('run_number')
                    ->numeric(),
                Tables\Columns\TextColumn::make('master_meter_volume')
                    ->label('Master Meter Volume'),
                Tables\Columns\TextColumn::make('line_meter_volume')
                    ->label('Line Meter Volume'),
                Tables\Columns\TextColumn::make('difference')
                    ->label('Difference'),
                Tables\Columns\TextColumn::make('meter_factor')
                    ->label('Meter Factor'),
                Tables\Columns\TextColumn::make('percentage_error')
                    ->label('% Error'),
                Tables\Columns\TextColumn::make('remarks')
                    ->label('Remarks'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make()
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->modalWidth('7xl'),
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
}
