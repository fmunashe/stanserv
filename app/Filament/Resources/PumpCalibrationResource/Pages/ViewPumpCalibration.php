<?php

namespace App\Filament\Resources\PumpCalibrationResource\Pages;

use App\Filament\Resources\PumpCalibrationResource;
use App\Models\PumpCalibration;
use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ViewRecord;

class ViewPumpCalibration extends ViewRecord
{
    protected static string $resource = PumpCalibrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Action::make('Generate Certificate')
                ->icon('heroicon-m-arrow-down')
                ->color('warning')
                ->url(fn(PumpCalibration $record) => route('pumpCalibrationCertificate', $record))
                ->openUrlInNewTab(),

            Actions\Action::make('updateAverages')
                ->icon('heroicon-m-cog')
                ->color('success')
                ->label('Calculate Averages')
                ->action(function ($record, array $data): void {
                    if ($data['confirm']) {
                        $beforeAdjustmentsRecords = $record->calibrationMeasureDetails()->wherein('id', $data['averageErrorBeforeAdjustments'])->get(['corrected_volume', 'difference']);
                        $percentageErrors = array();
                        foreach ($beforeAdjustmentsRecords as $beforeAdjustment) {
                            $error = ($beforeAdjustment->difference / $beforeAdjustment->corrected_volume) * 100;
                            $percentageErrors[] = $error;
                        }
                        $averageErrorBeforeAdjustments = collect($percentageErrors)->avg();

                        $forTheLastRecords = $record->calibrationMeasureDetails()->wherein('id', $data['averageErrorForTheLast'])->get(['corrected_volume', 'difference']);
                        $percentageErrors = array();
                        foreach ($forTheLastRecords as $forTheLastRecord) {
                            $error = ($forTheLastRecord->difference / $forTheLastRecord->corrected_volume) * 100;
                            $percentageErrors[] = $error;
                        }
                        $averageErrorForTheLast = collect($percentageErrors)->avg();

                        PumpCalibration::query()->where('id', '=', $record->id)
                            ->update([
                                'avg_pump_percentage_error_before_adjustments' => number_format($averageErrorBeforeAdjustments, 3, '.', ''),
                                'avg_pump_percentage_error_before_assize' => number_format($averageErrorForTheLast, 3, '.', '')
                            ]);
                        Notification::make()
                            ->title('Success')
                            ->body("Averages successfully calculated, refresh this page to see the updated details")
                            ->success()
                            ->persistent()
                            ->send();
                    } else {
                        Notification::make()
                            ->title('Error')
                            ->body('Please confirm you want to update the averages for this calibration')
                            ->danger()
                            ->send();
                    }
                })
                ->form([
                    Select::make('averageErrorBeforeAdjustments')
                        ->label('Average Error Before Adjustments')
                        ->required()
                        ->searchable()
                        ->preload()
                        ->multiple()
                        ->options($this->record->calibrationMeasureDetails->pluck('difference', 'id')->toArray()),

                    Select::make('averageErrorForTheLast')
                        ->label('Average Error For The Last')
                        ->required()
                        ->searchable()
                        ->preload()
                        ->multiple()
                        ->options($this->record->calibrationMeasureDetails->pluck('difference', 'id')->toArray()),
                    Toggle::make('confirm')
                        ->label("Confirm Update Averages?")
                        ->required()
                ]),
        ];
    }
}
