<?php

namespace App\Filament\Resources\MeterCalibrationResource\Pages;

use App\Filament\Resources\MeterCalibrationResource;
use App\Models\MeterCalibration;
use Filament\Actions;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Log;

class ViewMeterCalibration extends ViewRecord
{
    protected static string $resource = MeterCalibrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Action::make('Generate Certificate')
                ->icon('heroicon-m-arrow-down')
                ->color('warning')
                ->url(fn(MeterCalibration $record) => route('meterCalibrationCertificate', $record))
                ->openUrlInNewTab(),
            Actions\Action::make('updateAverages')
                ->icon('heroicon-m-cog')
                ->color('success')
                ->label('Update Calibration Averages')
                ->action(function ($record, array $data): void {
                    if ($data['confirm']) {
                        $averagePercentageError = $record->calibrationMeasureDetails()->latest()->take(4)->pluck('percentage_error')->avg();
                        $averageMeterFactor = $record->calibrationMeasureDetails()->latest()->take(4)->pluck('meter_factor')->avg();
                        MeterCalibration::query()->where('id', '=', $record->id)
                            ->update([
                                'avg_meter_factor_for_the_last_four_readings' => $averageMeterFactor,
                                'avg_meter_percentage_error_for_the_last_four_readings' => $averagePercentageError
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
                    Toggle::make('confirm')
                        ->label("Confirm Update Averages?")
                        ->required()
                ]),
        ];
    }
}
