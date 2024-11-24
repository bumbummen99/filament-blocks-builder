<?php

namespace Tests\SkyRaptor\FilamentBlocksBuilder\Concerns;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\Attributes\WithMigration;
use Orchestra\Testbench\Concerns\WithWorkbench;
use PHPUnit\Framework\Attributes\Before;
use Workbench\App\Models\User;

#[WithMigration]
trait RequiresApplicationEnvironment
{
    /* Use Orchestral Testbench's Workbench environment */
    use WithWorkbench;

    /* Ensure the databse is migrated & fresh before each test */
    use RefreshDatabase;

    /**
     * The default testing User
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