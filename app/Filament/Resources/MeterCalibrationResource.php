<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MeterCalibrationResource\Pages;
use App\Filament\Resources\MeterCalibrationResource\RelationManagers;
use App\Filament\Resources\MeterCalibrationResource\RelationManagers\TotaliserReadingRelationManager;
use App\Models\MeterCalibration;
use App\Models\MeterDetail;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationGroup;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Saade\FilamentAutograph\Forms\Components\SignaturePad;

class MeterCalibrationResource extends Resource
{
    protected static ?string $model = MeterCalibration::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('meter_owner_id')
                    ->relationship('meterOwner', 'company_name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->optionsLimit(5)
                    ->live()
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
                    ])
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('meter_detail_id', null);
                    }),
                Forms\Components\Select::make('meter_detail_id')
                    ->relationship('meterDetail', 'serial_number')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->options(function (callable $get) {
                        $meter_owner_id = $get('meter_owner_id');
                        if ($meter_owner_id) {
                            return MeterDetail::query()->where('meter_owner_id', $meter_owner_id)->pluck('serial_number', 'id');
                        }
                        return [];
                    })
                    ->live()
                    ->createOptionForm([
                        Forms\Components\Select::make('meter_owner_id')
                            ->label('Meter Owner')
                            ->relationship('meterOwner', 'company_name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->optionsLimit(5)
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
                    ]),
                Forms\Components\DatePicker::make('calibration_date')
                    ->required()
                    ->default(Carbon::now()),
                Forms\Components\DatePicker::make('next_date_of_calibration')
                    ->required()
                    ->default(Carbon::now()->addMonths(6)),
                Forms\Components\TextInput::make('calibration_product_used')
                    ->required(),
                Forms\Components\TextInput::make('calibration_method')
                    ->required(),
                Forms\Components\TextInput::make('sealing_pliers_number')
                    ->maxLength(255),
                Forms\Components\TextInput::make('avg_meter_percentage_error_before_adjustments'),
                Forms\Components\TextInput::make('avg_meter_percentage_error_for_the_last_four_readings'),
                Forms\Components\TextInput::make('avg_meter_factor_for_the_last_four_readings'),
                Forms\Components\TextInput::make('calibrated_by')
                    ->required()
                    ->maxLength(255)
                    ->default(Auth::user()->name),
                Forms\Components\TextInput::make('assisted_by')
                    ->maxLength(255),
                SignaturePad::make('signature')
                    ->label(__('Authorised Signature'))
                    ->dotSize(2.0)
                    ->lineMinWidth(0.5)
                    ->lineMaxWidth(2.5)
                    ->throttle(16)
                    ->minDistance(5)
                    ->velocityFilterWeight(0.7)
                    ->filename('autograph')
                    ->downloadable()
                    ->downloadActionDropdownPlacement('center-end')
                    ->confirmable(true)
                    ->columnSpanFull()
                    ->visible(function () {
                        return Auth::user()->roles()->whereHas('permissions', function ($query) {
                            $query->where('name', 'signature_pad_access');
                        })->exists();
                    })
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
                Tables\Columns\TextColumn::make('meterDetail.serial_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('calibration_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('next_date_of_calibration')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('calibrated_by')
                    ->searchable(),
                Tables\Columns\TextColumn::make('assisted_by')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sealing_pliers_number')
                    ->label('Sealing Pliers No')
                    ->searchable(),
                Tables\Columns\TextColumn::make('avg_meter_percentage_error_before_adjustments')
                    ->label('AVG % Error Before Adjustments ')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('avg_meter_percentage_error_for_the_last_four_readings')
                    ->label('AVG % Error Last 4 Readings')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('avg_meter_factor_for_the_last_four_readings')
                    ->label('AVG Meter Factor Last 4 Readings')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
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
            TotaliserReadingRelationManager::class,
            RelationManagers\CalibrationMeasureDetailsRelationManager::class,
            RelationManagers\MasterMeterRelationManager::class,
            RelationManagers\CertificateRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMeterCalibrations::route('/'),
            'create' => Pages\CreateMeterCalibration::route('/create'),
            'view' => Pages\ViewMeterCalibration::route('/{record}'),
            'edit' => Pages\EditMeterCalibration::route('/{record}/edit'),
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
