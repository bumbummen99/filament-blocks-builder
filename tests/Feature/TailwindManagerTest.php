<?php

namespace Tests\SkyRaptor\FilamentBlocksBuilder\Feature;

use Illuminate\Support\Collection;
use SkyRaptor\FilamentBlocksBuilder\Exceptions\InvalidTailwindPathException;
use SkyRaptor\FilamentBlocksBuilder\Facades\FilamentBlocksBuilderTailwindManager;

class TailwindManagerTest extends TestCase
{
    /**
     * This test is intended to verify the tailwind manager is working overall
     */
    function test_tailwind_manager_working()
    {
        // Define some valid paths from vendor/
        $paths = Collection::make([
            'bin/phpunit',
            'bin/testbench',
            'composer/LICENSE'
        ]);

        // Register the previously defined paths
        $paths->each(fn($path) => FilamentBlocksBuilderTailwindManager::register($path));

        // Ensure the paths are registered as expected
        $this->assertEquals(
            $paths->map(fn($path) => "vendor/{$path}")->toArray(),
            FilamentBlocksBuilderTailwindManager::paths()
        );
    }

    /**
     * This test is intended to verify the tailwind manager does verify
     * the provided paths.
     */
    function test_tailwind_manager_verify_paths()
    {
        $this->expectException(InvalidTailwindPathException::class);

        FilamentBlocksBuilderTailwindManager::register('this/does/not/exist');
    }

    function test_tailwind_paths_command()
    {
        // Define some valid paths from vendor/
        $paths = Collection::make([
            'bin/phpunit',
            'bin/testbench',
            'composer/LICENSE'
        ]);

        // Register the previously defined paths
        $paths->each(fn($path) => FilamentBlocksBuilderTailwindManager::register($path));

        $expected = $paths->map(fn($path) => "vendor/{$path}")->toJson();

        $this->artisan('filament-blocks-builder:tailwindpaths')
            ->expectsOutput($expected)
            ->assertSuccessful();
    }
}
