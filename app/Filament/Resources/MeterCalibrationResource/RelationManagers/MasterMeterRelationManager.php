<?php

namespace App\Filament\Resources\MeterCalibrationResource\RelationManagers;

use App\Models\MasterMeter;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class MasterMeterRelationManager extends RelationManager
{
    protected static string $relationship = 'masterMeter';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('meter_type_id')
                    ->relationship('meterType', 'meter_type')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('model')
                    ->required(),
                Forms\Components\TextInput::make('serial_number')
                    ->required(),
                Forms\Components\TextInput::make('flow_rate')
                    ->required(),
                Forms\Components\Repeater::make('totaliserReading')
                    ->label('Master Meter Totaliser Reading')
                    ->relationship('totaliserReading')
                    ->schema([
                        Forms\Components\TextInput::make('tot_start')
                            ->label('TOT START')
                            ->required()
                            ->numeric()
                            ->live()
                            ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                if ($get('tot_start')
                                    && $get('tot_finish')
                                ) {
                                    $set('prod_drawn', $get('tot_finish') - $get('tot_start'));
                                } else {
                                    $set('prod_drawn', 0.00);
                                }
                            }),
                        Forms\Components\TextInput::make('tot_finish')
                            ->label('TOT FINISH')
                            ->required()
                            ->numeric()
                            ->live()
                            ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                if ($get('tot_start')
                                    && $get('tot_finish')
                                ) {
                                    $set('prod_drawn', $get('tot_finish') - $get('tot_start'));
                                } else {
                                    $set('prod_drawn', 0.00);
                                }
                            }),
                        Forms\Components\TextInput::make('prod_drawn')
                            ->label('PROD DRAWN')
                            ->required()
                            ->numeric()
                            ->live()
                            ->readOnly(),
                    ])
                    ->deletable(false)
                    ->addable(false)
                    ->columns(3)
                    ->columnSpanFull(),
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
                Tables\Columns\TextColumn::make('meterType.meter_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('model')
                    ->searchable(),
                Tables\Columns\TextColumn::make('serial_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('flow_rate')
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make()
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->before(function (CreateAction $action, RelationManager $livewire) {
                        $calibration = $this->ownerRecord;
                        $existingMasterMeter = MasterMeter::where('meter_calibration_id', $calibration->id)->first();
                        if ($existingMasterMeter) {
                            Notification::make()
                                ->danger()
                                ->title('Master Meter Issue!')
                                ->body('You have already captured a master meter for this calibration. If you want to update the entry choose the edit button instead or delete the entry permanently and recapture.')
                                ->persistent()
                                ->send();

                            $action->halt();
                        }
                    })
                    ->modalWidth('5xl'),
                ExportAction::make()
                    ->exports([
                        ExcelExport::make()
                            ->fromTable()
                            ->askForFilename()
                            ->askForWriterType()
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
