<?php

namespace App\Providers\Filament;

use Filament\Enums\ThemeMode;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class StanservPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('stanserv')
            ->path('stanserv')
            ->login()
            ->registration()
            ->passwordReset()
            ->profile(isSimple: false)
            ->emailVerification()
            ->brandName('Stanserv Genuine Services')
            ->defaultThemeMode(ThemeMode::Light)
            ->colors([
//                'primary' => Color::Teal,
                'primary' => Color::rgb('rgb(45,53,139)'),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
//                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            //                        ->sidebarCollapsibleOnDesktop()
            ->sidebarFullyCollapsibleOnDesktop()
//            ->topNavigation()
//            ->topbar(false)
//            ->breadcrumbs(false)
//            ->brandLogo(asset('images/logo.png'))
                ->brandLogo(url('https://www.econet.co.zw/wp-content/uploads/2022/05/EconetLogo.png'))
            ->favicon(asset('images/logo.png'))
            ->brandLogoHeight(1)
//            ->sidebarWidth('17rem')
            ->maxContentWidth(MaxWidth::Full)
            ->navigationGroups([
                NavigationGroup::make()
                    ->label('User Management')
                    ->icon('heroicon-o-user-group'),
                NavigationGroup::make()
                    ->label('Pumps')
                    ->icon('heroicon-o-pencil'),
                NavigationGroup::make()
                    ->label('Meters')
                    ->icon('heroicon-o-signal'),
                NavigationGroup::make()
                    ->label('Truck Details')
                    ->icon('heroicon-o-truck'),
                NavigationGroup::make()
                    ->label('Settings')
                    ->icon('heroicon-o-cog-6-tooth'),
            ]);
    }
}
