<?php

namespace SkyRaptor\FilamentBlocksBuilder;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use SkyRaptor\FilamentBlocksBuilder\Exceptions\InvalidTailwindPathException;

/**
 * This class is responsible managing paths
 * to files that contain Tailwind CSS
 * that is relevant for compilation.
 */
class FilamentBlocksBuilderTailwindManager
{
    private Collection $paths;

    public function __construct()
    {
        $this->paths = new Collection();
    }

    /**
     * Register the provided path internally
     * 
     * @param string $path 
     * @return void 
     * @throws BindingResolutionException 
     * @throws Exception 
     */
    public function register(string $path): void
    {
        $prepended = Str::of($path)
            ->prepend('vendor' . DIRECTORY_SEPARATOR)
            ->toString();

        // Build the absolute path
        $absolute = base_path($prepended);

        if (! file_exists($absolute)) {
            throw new InvalidTailwindPathException("Provided invalid Tailwind CSS build path {$path}");
        }

        // Prevent duplicates
        if (! $this->paths->contains($prepended)) {
            $this->paths->add($prepended);
        }
    }

    /**
     * Provides the currently collected paths.
     * 
     * @return array 
     */
    public function paths(): array
    {
        return $this->paths->toArray();
    }
}
