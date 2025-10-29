<?php

namespace SkyRaptor\FilamentBlocksBuilder;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;
use SkyRaptor\FilamentBlocksBuilder\Blocks\Contracts\Block;

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

                if (is_subclass_of($fqcn, Block::class)) {
                    return View::make(
                        $fqcn::view(),
                        Arr::get($block, 'data', [])
                    )->render();
                } else {
                    throw new Exception('Invalid Block Type');
                }
            })
            ->filter(fn($i) => ! is_null($i))
            ->join('');

        return $output;
    }
}
