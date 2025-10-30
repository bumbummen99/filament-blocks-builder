<?php

namespace SkyRaptor\FilamentBlocksBuilder\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static void register(string $path)
 * @method static array paths()
 * 
 * @package SkyRaptor\FilamentBlocksBuilder\Facades
 */
class FilamentBlocksBuilderTailwindManager extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return \SkyRaptor\FilamentBlocksBuilder\FilamentBlocksBuilderTailwindManager::class;
    }
}
