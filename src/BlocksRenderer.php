<?php

namespace SkyRaptor\FilamentBlocksBuilder;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
use SkyRaptor\FilamentBlocksBuilder\Blocks\Contracts\HTMLBlock;
use SkyRaptor\FilamentBlocksBuilder\Exceptions\InvalidBlockTypeException;

/**
 * This class is responsible for rendering the 
 * provided blocks using their implementation.
 */
class BlocksRenderer
{
    public static function render(array $expression): string
    {
        $output = Collection::make($expression)
            ->map(function (array $block) {
                $fqcn = Arr::get($block, 'type');

                if (is_subclass_of($fqcn, HTMLBlock::class)) {
                    return $fqcn::render(
                        Arr::get($block, 'data', [])
                    );
                } else {
                    throw new InvalidBlockTypeException("Invalid Block type {$fqcn}");
                }
            })
            ->filter(fn($i) => ! is_null($i))
            ->join('');

        return $output;
    }
}
