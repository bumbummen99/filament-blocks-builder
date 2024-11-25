<?php

namespace Tests\SkyRaptor\FilamentBlocksBuilder\Browser;

use Illuminate\Support\Facades\Config;
use Laravel\Dusk\Browser;
use Orchestra\Testbench\Dusk\Options;
use Workbench\App\Models\User;

/**
 * This test is intended to function as a self check   
 * to detect ill configured test environments.
 */
class BrowserEnvironmentTest extends TestCase
{
    /**
     * Prepare the testing environment web driver options.
     * 
     * @see https://packages.tools/testbench-dusk/the-basic.html#running-with-or-without-ui
     */
    public static function defineWebDriverOptions() 
    {
        Options::withoutUI();
    }

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
    function test_database_is_cleaned_between_tests_prepare() {+
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

    /**
     * This test is intended to ensure that the default
     * testing User can login using the frontend.
     */
    function test_default_testing_user_can_login()
    {
        $this->browse(function (Browser $browser) {
            /* Logout the default testing User just in case */
            $browser->logout();
            
            /* Open the Filament PHP login page */
            $browser->visit('/admin/login');

            /* Fill the login form */
            $browser->type('#data\.email', $this->user->email);
            $browser->type('#data\.password', static::$password);

            /* Submit the login form */
            $browser->press('Sign in');

            /* Wait for the redirection */
            $browser->waitForLocation('/admin');

            /* Ensure the login was successful */
            $browser->assertPathIs('/admin');
        });
    }
}