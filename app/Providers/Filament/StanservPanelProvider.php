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
                'primary' => Color::Teal,
//                'primary' => Color::rgb('rgb(149,208,224)'),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
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
//                \Hasnayeen\Themes\Http\Middleware\SetTheme::class
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugins([
//                \Hasnayeen\Themes\ThemesPlugin::make()
            ])
            ->sidebarFullyCollapsibleOnDesktop()
            ->brandLogo(asset('images/logo-latest.svg'))
            ->favicon(asset('images/logo-latest.svg'))
            ->brandLogoHeight("60px")
            ->maxContentWidth(MaxWidth::Full)
            ->navigationGroups([
                NavigationGroup::make()
                    ->label('Users')
                    ->icon('heroicon-o-user-group'),
                NavigationGroup::make()
                    ->label('Pumps')
                    ->icon('heroicon-o-pencil'),
                NavigationGroup::make()
                    ->label('Meters')
                    ->icon('heroicon-o-signal'),
                NavigationGroup::make()
                    ->label('Trucks')
                    ->icon('heroicon-o-truck'),
                NavigationGroup::make()
                    ->label('Settings')
                    ->icon('heroicon-o-cog-6-tooth'),
            ]);
    }
}
