<?php

namespace Tests\SkyRaptor\FilamentBlocksBuilder\Browser;

use Illuminate\Contracts\Config\Repository;
use Tests\SkyRaptor\FilamentBlocksBuilder\Concerns\RequiresApplicationEnvironment;

/**
 * This class acts as the TestCase super to be extended in
 * case a Browser test is implemented.
 */
class TestCase extends \Orchestra\Testbench\Dusk\TestCase
{
    use RequiresApplicationEnvironment;

    /**
     * Define environment setup.
     *
     * @param  Illuminate\Foundation\Application  $app
     *
     * @return void
     */
    protected function defineEnvironment($app) 
    {
        /**
         * Ensure Browser tests use the peristent SQLite database file managed by Orchestral Dusk.
         * 
         * @see https://packages.tools/testbench-dusk/the-basic.html#supported-database
         */
        tap($app['config'], function (Repository $config) {
            $config->set('database.default', 'sqlite');
        });
    }
}