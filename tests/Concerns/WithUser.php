<?php

namespace Tests\SkyRaptor\FilamentBlocksBuilder\Concerns;

use Illuminate\Support\Facades\Hash;
use Workbench\App\Models\User;

/**
 * This Concern is intended to create and manage the default testing User.
 * 
 * @mixin \Orchestra\Testbench\TestCase
 */
trait WithUser
{
    /**
     * Defines the password of the default testing User.
     */
    protected static string $password = 'password';

    /**
     * The current testing User
     */
    protected User $user;

    protected function createDefaultTestingUser(): void
    {
        /* Create the default testing User */
        $this->user = User::factory()->create([
            /* Ensure a consistent password */
            'password' => Hash::make(static::$password)
        ]);

        /* Act as default testing User in current context */
        $this->actingAs($this->user);
    }
}