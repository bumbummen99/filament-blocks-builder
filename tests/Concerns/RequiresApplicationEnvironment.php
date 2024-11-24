<?php

namespace Tests\SkyRaptor\FilamentBlocksBuilder\Concerns;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\Concerns\WithLaravelMigrations;
use Orchestra\Testbench\Concerns\WithWorkbench;
use Workbench\App\Models\User;

/**
 * This Concern is intended to initialize the basic
 * application environment for more in-depth tests.
 */
trait RequiresApplicationEnvironment
{
    /**
     * Use Orchestral Testbench's Workbench & load testbench.yaml.
     * 
     * @see https://packages.tools/testbench.html#autoloading-using-testbench-yaml
     */
    use WithWorkbench;

    /**
     * Run Laravel Migrations defined in Orchestral Testbench's Workbench environment.
     */
    use WithLaravelMigrations;

    /**
     * Ensure the databse is migrated & fresh before each test.
     * 
     * @see https://laravel.com/docs/11.x/database-testing#resetting-the-database-after-each-test
     */
    use RefreshDatabase;

    /**
     * The default testing User Fixture
     */
    protected User $user;

    /**
     * This method is responsible for setting up anything
     * implemented throught this Trait by using the 
     * PHPUnit "setUp" annotation.
     * 
     * @setUp
     */
    protected function setUpRequiresApplicationEnvironment(): void
    {
        /* Setup the default testing User */
        $this->user = $this->createUser();
        $this->actingAs($this->user);
    }

    /**
     * This helper method does create a new
     * User using the Model's Factory.
     */
    protected function createUser(): User
    {
        return User::factory()->create();
    }
}