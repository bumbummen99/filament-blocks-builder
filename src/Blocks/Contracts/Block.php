<?php

namespace SkyRaptor\FilamentBlocksBuilder\Blocks\Contracts;

use Filament\Forms\Components\Builder;
use Filament\Forms\Form;
use Illuminate\Support\Str;

abstract class Block
{
    /**
     * Creates the Filament PHP Forms Component for this Block.
     */
    public static function block(Form $form): Builder\Block
    {
        return Builder\Block::make(static::class)
            // Derive a basic label from the class name
            ->label(Str::of(static::class)->classBasename()->toString());
    }
}
