<?php

namespace App\Filament\Resources\PumpCalibrationResource\RelationManagers;

use App\Models\PumpCalibrationTotaliserReading;
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
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class TotaliserReadingRelationManager extends RelationManager
{
    protected static string $relationship = 'totaliserReading';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('tot_finish')
                    ->label('TOT FINISH')
                    ->required()
                    ->numeric()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $get, callable $set) {
                        if ($get('tot_start')
                            && $get('tot_finish')
                        ) {
                          $set('prod_drawn', round($get('tot_finish') - $get('tot_start'),1));
                        } else {
                            $set('prod_drawn', 0.00);
                        }
                    }),
                Forms\Components\TextInput::make('tot_start')
                    ->label('TOT START')
                    ->required()
                    ->numeric()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $get, callable $set) {
                        if ($get('tot_start')
                            && $get('tot_finish')
                        ) {
                            $set('prod_drawn', round($get('tot_finish') - $get('tot_start'),1));
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
            ->columns(3);
    }

    /**
     * @throws \Exception
     */
    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('tot_start')
                    ->label('TOT START'),
                Tables\Columns\TextColumn::make('tot_finish')
                    ->label('TOT FINISH'),
                Tables\Columns\TextColumn::make('prod_drawn')
                    ->label('PROD DRAWN')
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make()
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
//                    ->before(function (CreateAction $action, RelationManager $livewire) {
//                        $calibration = $this->ownerRecord;
//                        $existingTotaliser = PumpCalibrationTotaliserReading::where('pump_calibration_id', $calibration->id)->first();
//                        if ($existingTotaliser) {
//                            Notification::make()
//                                ->danger()
//                                ->title('Totaliser Readings Issue!')
//                                ->body('You have already captured totaliser readings for this calibration. If you want to update the entry choose the edit button instead or delete the entry permanently and recapture.')
//                                ->persistent()
//                                ->send();
//
//                            $action->halt();
//                        }
//                    })
                    ->modalWidth('5xl'),
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
                    ])
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
