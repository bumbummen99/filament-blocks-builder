<?php

namespace SkyRaptor\FilamentBlocksBuilder\Blocks\Contracts;

use Illuminate\Support\Facades\View;

abstract class HTMLBlock extends Block
{
    /**
     * Defines the view of the Block
     */
    public abstract static function view(): ?string;

    /**
     * Renders the Block
     */
    public static function render(array $data): string
    {
        // Determine if this Block has a view
        if (is_string(static::view())) {
            // Render using the view
            return View::make(static::view(), $data)->render();
        }

        // Demand specific implementation in case there is no view
        throw new \Exception('render method not implemented.');
    }
}
