<?php

namespace SkyRaptor\FilamentBlocksBuilder;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use SkyRaptor\FilamentBlocksBuilder\Console\Commands\TailwindPaths;

class FilamentBlocksBuilderServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->singleton(FilamentBlocksBuilderTailwindManager::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register the command if we are using the application via the CLI
        if ($this->app->runningInConsole()) {
            $this->commands([
                TailwindPaths::class,
            ]);
        }

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
