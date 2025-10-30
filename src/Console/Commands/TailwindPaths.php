<?php

namespace SkyRaptor\FilamentBlocksBuilder\Console\Commands;

use Illuminate\Console\Command;
use SkyRaptor\FilamentBlocksBuilder\FilamentBlocksBuilderTailwindCSSManager;

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
    public function handle(FilamentBlocksBuilderTailwindCSSManager $manager): void
    {
        $this->info($manager->paths());
    }
}
