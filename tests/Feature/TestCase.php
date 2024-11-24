<?php

namespace Tests\SkyRaptor\FilamentBlocksBuilder\Feature;

use Tests\SkyRaptor\FilamentBlocksBuilder\Concerns\RequiresApplicationEnvironment;

/**
 * This class acts as the TestCase super to be extended in
 * case a Feature test is implemented.
 */
class TestCase extends \Orchestra\Testbench\TestCase
{
    use RequiresApplicationEnvironment;
}