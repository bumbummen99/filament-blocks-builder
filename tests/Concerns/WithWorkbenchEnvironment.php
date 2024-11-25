<?php

namespace Tests\SkyRaptor\FilamentBlocksBuilder\Concerns;

use Orchestra\Testbench\Concerns\WithLaravelMigrations;
use Orchestra\Testbench\Concerns\WithWorkbench;

/**
 * This Concern is intended to initialize the basic
 * application environment for more in-depth tests.
 * 
 * @mixin \Orchestra\Testbench\TestCase
 */
trait WithWorkbenchEnvironment
{
    /**
     * Use Orchestral's Workbench environment & load testbench.yaml.
     * 
     * @see https://packages.tools/testbench.html#autoloading-using-testbench-yaml
     */
    use WithWorkbench;

    /**
     * Run the Laravel base migrations from the Orchestra Skeleton ()
     */
    use WithLaravelMigrations;
}