<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CalibrationFormResource\Pages;
use App\Filament\Resources\CalibrationFormResource\RelationManagers;
use App\Models\TruckOwnerDetail;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CalibrationFormResource extends Resource
{
//    protected static ?string $model = TruckOwnerDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Order')
                        ->icon('heroicon-m-shopping-bag')
                        ->schema([
                            TextInput::make('name')
                                ->required(),
                            TextInput::make('fax')
                                ->required(),
                            Textarea::make('address')
                                ->required(),
                        ]),
                    Wizard\Step::make('Delivery')
                        ->icon('heroicon-m-shopping-bag')
                        ->schema([
                            TextInput::make('driver')
                                ->required(),
                        ]),
                    Wizard\Step::make('Billing')
                        ->icon('heroicon-m-shopping-cart')
                        ->schema([
                            // ...
                        ]),
                ])->columnSpanFull()
            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
//                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListCalibrationForms::route('/'),
            'create' => Pages\CreateCalibrationForm::route('/create'),
            'view' => Pages\ViewCalibrationForm::route('/{record}'),
            'edit' => Pages\EditCalibrationForm::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
}
