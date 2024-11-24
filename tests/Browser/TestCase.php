<?php

namespace Tests\SkyRaptor\FilamentBlocksBuilder\Browser;

use Tests\SkyRaptor\FilamentBlocksBuilder\Concerns\RequiresApplicationEnvironment;

/**
 * This class acts as the TestCase super to be extended in
 * case a Browser test is implemented.
 */
class TestCase extends \Orchestra\Testbench\Dusk\TestCase
{
    use RequiresApplicationEnvironment;
}