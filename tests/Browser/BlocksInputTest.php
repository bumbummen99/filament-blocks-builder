<?php

namespace Tests\SkyRaptor\FilamentBlocksBuilder\Browser;

use Laravel\Dusk\Browser;

class BlocksInputTest extends TestCase
{
    /**
     * This test is intended to ensure that nested BlocksInput
     * instances do work and interact as intended.
     */
    function test_nested_builders_interaction()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit('/admin/login')
                ->type('email', $this->user->email)
                ->type('password', 'password')
                ->press('Login')
                ->assertPathIs('/admin');
        });
    }
}