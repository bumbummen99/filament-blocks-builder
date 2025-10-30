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
        $paths = static::validPaths();

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
        // Define some valid paths from testbench-core/laravel
        $paths = static::validPaths();

        // Register the previously defined paths
        $paths->each(fn($path) => FilamentBlocksBuilderTailwindManager::register($path));

        $expected = $paths->map(fn($path) => "vendor/{$path}")->toJson();

        $this->artisan('filament-blocks-builder:tailwindpaths')
            ->expectsOutput($expected)
            ->assertSuccessful();
    }

    /**
     * Retrieve some file paths that are available in testbench-core/laravel
     * @return Collection 
     */
    protected static function validPaths(): Collection
    {
        if (! file_exists(base_path('vendor'))) {
            mkdir(base_path('vendor'), 0777, true);
        }

        // Define the list of valid files
        $paths = Collection::make([
            'file1',
            'file2',
            'file3'
        ]);

        // Create (empty) files
        $paths->each(fn($path) => file_put_contents(base_path("vendor/{$path}"), ''));

        return $paths;
    }
}
