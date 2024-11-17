<?php

namespace SkyRaptor\FilamentBlocksBuilder\Blocks\Contracts;

use Filament\Forms\Components\Builder;
use Filament\Forms\Form;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

abstract class Block
{
    /**
     * Creates the Filament PHP Forms Component for this Block.
     */
    public static function block(Form $form): Builder\Block
    {
        return Builder\Block::make(static::class)
            /* Derive a basic label from the class name */
            ->label(Str::of(static::class)->classBasename()->toString());
    }

    /**
     * Provides the View to be used to render this Block.
     */
    public abstract static function view(): string;

    /**
     * Provides the frontend requirements for this Block.
     */
    public static function requirements(): Collection
    {
        return Collection::make();
    }
}