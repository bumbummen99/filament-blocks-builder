<?php

namespace SkyRaptor\FilamentBlocksBuilder\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use SkyRaptor\FilamentBlocksBuilder\FilamentBlocksBuilderTailwindManager;

/**
 * This Artisan command returns the collected paths relevant 
 * for any Tailwind CSS build process. Make sure to include 
 * this in your Tailwind configuration's 'content' section.
 * 
 * @package SkyRaptor\FilamentBlocksBuilder\Console\Commands
 */
class TailwindPaths extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'filament-blocks-builder:tailwindpaths';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a marketing email to a user';

    /**
     * Execute the console command.
     */
    public function handle(FilamentBlocksBuilderTailwindManager $manager): void
    {
        $this->info(Collection::make($manager->paths())->toJson());
    }
}
