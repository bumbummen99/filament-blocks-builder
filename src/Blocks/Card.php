<?php

namespace SkyRaptor\FilamentBlocksBuilder\Blocks;

use Filament\Forms\Components\Builder;
use Filament\Forms\Form;
use SkyRaptor\FilamentBlocksBuilder\Blocks\Contracts\HTMLBlock;
use SkyRaptor\FilamentBlocksBuilder\Forms;

/**
 * This block defines a "card" component.
 */
class Card extends HTMLBlock
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

    public static function view(): ?string
    {
        return 'filament-blocks-builder::card';
    }
}
