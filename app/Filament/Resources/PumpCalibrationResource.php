<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PumpCalibrationResource\Pages;
use App\Filament\Resources\PumpCalibrationResource\RelationManagers;
use App\Models\PumpCalibration;
use App\Models\PumpDetail;
use App\Models\Signature;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class PumpCalibrationResource extends Resource
{
    protected static ?string $model = PumpCalibration::class;

    public static function form(Form $form): Form
    {
        return $form
            ->columns(3)
            ->schema([
                Forms\Components\Select::make('pump_owner_id')
                    ->required()
                    ->relationship('pumpOwner', 'company_name')
                    ->searchable()
                    ->label('Client')
                    ->preload()
                    ->optionsLimit(5)
                    ->live()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('company_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->label('Company Phone')
                            ->tel()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('Company Email')
                            ->email()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('contact_person')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('contact_person_phone')
                            ->tel()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('contact_person_email')
                            ->email()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('address')
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ]),
                Forms\Components\Select::make('pump_detail_id')
                    ->required()
                    ->relationship('pumpDetail', 'serial_number')
                    ->searchable()
                    ->label('Pump Details')
                    ->preload()
                    ->options(function (callable $get) {
                        $pump_owner_id = $get('pump_owner_id');
                        if ($pump_owner_id) {
                            return PumpDetail::query()->where('pump_owner_id', $pump_owner_id)->pluck('serial_number', 'id');
                        }
                        return [];
                    })
                    ->afterStateUpdated(function ($state, callable $set) {
                        $pump = PumpDetail::find($state);
                        if ($pump) {
                            $set('serial_number', $pump->serial_number);
                        }
                    })
                    ->live()
                    ->createOptionForm([
                        Forms\Components\Select::make('pump_owner_id')
                            ->label('Client')
                            ->relationship('pumpOwner', 'company_name')
                            ->searchable()
                            ->preload()
                            ->optionsLimit(5)
                            ->required()
                            ->live(),
                        Forms\Components\Select::make('pump_type_id')
                            ->relationship('pumpType', 'pump_type')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('pump_type')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('description')
                                    ->maxLength(255),
                            ]),
                        Forms\Components\Select::make('mode')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->options([
                                'Commercial' => 'Commercial',
                                'Commercial Trade' => 'Commercial Trade',
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
                            ->maxLength(255),
                        Forms\Components\TextInput::make('flow_rate')
                            ->required()
                            ->maxLength(255),
                    ]),
                Forms\Components\DatePicker::make('calibration_date')
                    ->required()
                    ->default(Carbon::now())
                    ->live()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $date = Carbon::parse($state)->addMonths(6)->format('d-m-Y');
                        $set('next_date_of_calibration', $date);
                    })
                    ->live(),
                Forms\Components\DatePicker::make('next_date_of_calibration')
                    ->required()
                    ->default(Carbon::now()->addMonths(6))
                    ->live()
                    ->readOnly(),
                Forms\Components\Select::make('calibration_product_id')
                    ->relationship(
                        'calibrationProduct',
                        'name',
                        modifyQueryUsing: fn ($query) => $query->whereNotNull('name'))
                    ->searchable()
                    ->preload()
                    ->required()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                    ]),
                Forms\Components\TextInput::make('calibration_method')
                    ->required(),
                Forms\Components\TextInput::make('sealing_pliers_number')
                    ->label('Sealing Pliers Number')
                    ->maxLength(255)
                    ->required(),
                Forms\Components\TextInput::make('avg_pump_percentage_error_before_adjustments')
                    ->label('Average Pump Percentage Error Before Any Adjustments'),
                Forms\Components\TextInput::make('avg_pump_percentage_error_before_assize')
                    ->label('Average Pump Percentage Error For The Last Five Readings Before Assize'),
                Forms\Components\TextInput::make('calibrated_by')
                    ->required()
                    ->default(Auth::user()->name),
                Forms\Components\TextInput::make('assisted_by')
                    ->maxLength(255),
                Forms\Components\TextInput::make('trade_measures_inspector')
                    ->label('Trade Measures Inspector')
                    ->maxLength(255)
                    ->required(),
                Forms\Components\Select::make('pump_calibration_status_id')
                    ->relationship('pumpCalibrationStatus', 'status')
                    ->searchable()
                    ->preload(),
                Forms\Components\Textarea::make('average_pump_percentage_error_wording')
                    ->label('Average Pump Percentage Error Wording')
                    ->required()
                    ->columnSpanFull(),
//                SignaturePad::make('signature')
//                    ->label(__('Authorised Signature'))
//                    ->dotSize(2.0)
//                    ->lineMinWidth(0.5)
//                    ->lineMaxWidth(2.5)
//                    ->throttle(16)
//                    ->minDistance(5)
//                    ->velocityFilterWeight(0.7)
//                    ->filename('autograph')
//                    ->downloadable()
//                    ->downloadActionDropdownPlacement('center-end')
//                    ->confirmable(true)
//                    ->columnSpanFull()
//                    ->visible(function () {
//                        return Auth::user()->roles()->whereHas('permissions', function ($query) {
//                            $query->where('name', 'signature_pad_access');
//                        })->exists();
//                    }),
                Forms\Components\Select::make('signature_id')
                    ->searchable()
                    ->label('Signature')
                    ->preload()
                    ->options(function () {
                        return Signature::with('user')->get()->pluck('user.name', 'id');
                    })
                    ->live()
            ]);
    }

    /**
     * @throws \Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pumpOwner.company_name')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('pumpDetail.location')
                    ->label('Location')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('pumpDetail.serial_number')
                    ->label('Pump Serial Number')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('calibration_date')
                    ->date()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('next_date_of_calibration')
                    ->date()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('calibrated_by')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('assisted_by')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('material_of_construction')
                    ->sortable()
                    ->searchable()
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
                Tables\Filters\SelectFilter::make('pump_owner_id')
                    ->label('Pump Owner')
                    ->multiple()
                    ->options([
                        'pump_owner_id' => 'Pump Owner',
                    ])
                    ->searchable()
                    ->relationship('pumpOwner', 'company_name')
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
                Action::make('Generate Certificate')
                    ->requiresConfirmation()
                    ->icon('heroicon-m-arrow-down')
                    ->color('success')
                    ->url(fn(PumpCalibration $record) => route('pumpCalibrationCertificate', $record))
                    ->openUrlInNewTab(),
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
            RelationManagers\CalibrationStandardsRelationManager::class,
            RelationManagers\TotaliserReadingRelationManager::class,
            RelationManagers\CalibrationMeasureDetailsRelationManager::class,
            RelationManagers\CertificateRelationManager::class
//            AuditsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPumpCalibrations::route('/'),
            'create' => Pages\CreatePumpCalibration::route('/create'),
            'view' => Pages\ViewPumpCalibration::route('/{record}'),
            'edit' => Pages\EditPumpCalibration::route('/{record}/edit'),
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
