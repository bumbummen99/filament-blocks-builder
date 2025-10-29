<?php

namespace SkyRaptor\FilamentBlocksBuilder;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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
        // Load the views provided by this package
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'filament-blocks-builder');

        // Register a Blade Directive to render Blocks.
        Blade::directive('blocks', function (string $expression) {
            return Str::replaceArray('$', [
                BlocksRenderer::class,
                $expression
            ], "<?php echo $::render($); ?>");
        });
    }
}
