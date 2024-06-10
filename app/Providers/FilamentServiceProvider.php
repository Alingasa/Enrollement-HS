<?php

namespace App\Providers;

use Filament\Panel;
use Filament\Support\Colors\Color;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        Model::shouldBeStrict();

        static::configPanel();
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    public function configPanel():void
    {
        Panel::configureUsing(function (Panel $panel) {
            $panel
                ->spa()
                ->profile(isSimple: false)
                ->colors([
                    'primary' => Color::Sky,
                ]);
        });
    }
}
