<?php

namespace SkyRaptor\FilamentBlocksBuilder\Blocks\Layout;

use Closure;
use Filament\Forms\Components\Builder;
use Filament\Forms\Form;
use SkyRaptor\FilamentBlocksBuilder\Blocks\Contracts\Block;
use SkyRaptor\FilamentBlocksBuilder\Forms;

/**
 * This layout block defines a "card" component.
 */
class Card extends Block
{
    /**
     * @inheritDoc
     */
    public static function block(): Closure
    {
        return fn (Form $form) => Builder\Block::make(static::class)
            ->label('Card')
            ->schema([
                Forms\Components\BlocksInput::make('content')
                    ->blocks([]) // TODO
            ]);
    }

    public static function view(): string
    {
        return 'filament-blocks-builder::layout.card';
    }
}