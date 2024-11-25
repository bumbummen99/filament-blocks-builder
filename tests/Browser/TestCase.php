<?php

namespace Tests\SkyRaptor\FilamentBlocksBuilder\Browser;

use Illuminate\Contracts\Config\Repository;
use PHPUnit\Framework\Attributes\Before;
use Tests\SkyRaptor\FilamentBlocksBuilder\Concerns\WithWorkbenchEnvironment;
use Tests\SkyRaptor\FilamentBlocksBuilder\Concerns\WithUser;

/**
 * This class acts as the TestCase super to be extended in
 * case a Browser test is implemented.
 */
class TestCase extends \Orchestra\Testbench\Dusk\TestCase
{
    /* Load the Orchestral Workbench environment */
    use WithWorkbenchEnvironment;

    /* Create a default testing User for each test */
    use WithUser;

    /**
     * Define environment setup.
     *
     * @param  Illuminate\Foundation\Application  $app
     *
     * @return void
     */
    protected function defineEnvironment($app) 
    {
        tap($app['config'], function (Repository $config) {
            /**
             * Ensure Browser tests use the peristent SQLite database file managed by Orchestral Dusk.
             * 
             * @see https://packages.tools/testbench-dusk/the-basic.html#supported-database
             */
            $config->set('database.default', 'sqlite');

            /**
             * Correct the Application url configuration to include the Orchestral Dusk serve port.
             */
            $config->set('app.url', 'http://localhost:'.static::$baseServePort);
        });
    }

    /**
     * Overload trait method to ensure the SQLite file 
     * is prepared properly before each test.
     */
    #[Before]
    protected function createSQLiteDatabase(): void
    {
        $this->afterApplicationCreated(function () {
            /* Create the database file */
            $this->artisan('package:create-sqlite-db');

            /* Migrate the database */
            $this->artisan('migrate:fresh');

            /* Create the default testing User */
            $this->createDefaultTestingUser();
        });
    }
}