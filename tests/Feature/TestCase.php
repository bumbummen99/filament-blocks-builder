<?php

namespace Tests\SkyRaptor\FilamentBlocksBuilder\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Before;
use Tests\SkyRaptor\FilamentBlocksBuilder\Concerns\WithWorkbenchEnvironment;
use Tests\SkyRaptor\FilamentBlocksBuilder\Concerns\WithUser;

/**
 * This class acts as the TestCase super to be extended in
 * case a Feature test is implemented.
 */
class TestCase extends \Orchestra\Testbench\TestCase
{
    /* Load the Orchestral Workbench environment */
    use WithWorkbenchEnvironment;

    /* Automatically run migrations and use transactions for each test */
    use RefreshDatabase;

    /* Create a default testing User for each test */
    use WithUser;

    #[Before]
    function prepareDefaultTestingUser(): void
    {
        $this->afterApplicationCreated(fn () =>  $this->createDefaultTestingUser());
    }
}