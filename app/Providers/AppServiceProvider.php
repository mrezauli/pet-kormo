<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;
use Filament\Navigation\UserMenuItem;
use App\Filament\Pages\MyProfile;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Filament::serving(function () {
            // Using Vite
            Filament::registerViteTheme('resources/css/filament.css');
            Filament::serving(function () {
                Filament::registerUserMenuItems([
                    'account' => UserMenuItem::make()->url(MyProfile::getUrl()),
                ]);
            });
        });
    }
}