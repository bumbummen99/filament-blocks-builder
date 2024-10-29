<?php

namespace SkyRaptor\FilamentBlocksBuilder\Blocks\Contracts;

use Closure;
use Filament\Forms\Components\Builder;
use Filament\Forms\Form;
use Illuminate\Support\Collection;

abstract class Block
{
    /**
     * Create a new instance of this Block.
     */
    public static function make(): static
    {
        return new static;
    }

    /**
     * Defines the Form to edit this Block.
     * 
     * @return Closure(Form): Builder\Block
     */
    public abstract static function block(): Closure;

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