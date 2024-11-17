<?php

namespace Tests\SkyRaptor\FilamentBlocksBuilder;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\Attributes\WithMigration;
use Orchestra\Testbench\Concerns\WithWorkbench;
use Workbench\App\Models\User;

#[WithMigration] 
class FeatureTestCase extends TestCase
{
    /* (Re-)Migrate the Database before every test */
    use RefreshDatabase;

    /* Use Orchestra Workbench */
    use WithWorkbench;

    protected function setUp(): void
    {
        parent::setUp();

        /* Create the default, testing user */
        $this->actingAs($this->createUser());
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