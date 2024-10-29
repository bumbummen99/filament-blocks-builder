<?php

namespace SkyRaptor\FilamentBlocksBuilder;

use Illuminate\Support\ServiceProvider;

class FilamentBlocksBuilderServiceProvider extends ServiceProvider
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
        /* Load the views provided by this package */
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'filament-blocks-builder');
    }
}