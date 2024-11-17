<?php

namespace SkyRaptor\FilamentBlocksBuilder\Blocks\Layout;

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
    public static function block(Form $form): Builder\Block
    {
        return parent::block($form)->schema([
            Forms\Components\BlocksInput::make('content')
        ]);
    }

    public static function view(): string
    {
        return 'filament-blocks-builder::layout.card';
    }
}