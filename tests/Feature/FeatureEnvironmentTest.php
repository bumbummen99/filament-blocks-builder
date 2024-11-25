<?php

namespace Tests\SkyRaptor\FilamentBlocksBuilder\Feature;

use Illuminate\Support\Facades\Config;
use Workbench\App\Models\User;

class FeatureEnvironmentTest extends TestCase
{
    /**
     * This test is intended to validate that the test environment
     * does correctly configure the User model.
     */
    function test_configuration_does_use_correct_user_model()
    {
        /* Read the currently configured User model FQCN */
        $model = Config::get('auth.providers.users.model');

        /* Ensure the configured FQCN is correct */
        $this->assertSame(User::class, $model);
    }

    /**
     * This test is intended to validate that the test environment
     * does correctly migrate the database.
     */
    function test_database_is_migrated()
    {
        /* Ensure that there are no pending migrations */
        $this->artisan('migrate:status')
            ->doesntExpectOutputToContain('Pending');
    }

    /**
     * This test is intended to prepare the next test.
     */
    function test_database_is_cleaned_between_tests_prepare()
    {
        /* This test is not intended perform any assertions */
        $this->expectNotToPerformAssertions();
        
        /* Create a new User for the next test */
        User::factory()->create();
    }

    /**
     * This test is intended to validate that the test environment
     * does correctly migrate the database.
     */
    function test_database_is_cleaned_between_tests()
    {
        /* Ensure the Users created in the last test do no longer exist */
        $this->assertSame(1, User::count());
    }
}