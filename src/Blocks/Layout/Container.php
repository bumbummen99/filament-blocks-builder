<?php

namespace SkyRaptor\FilamentBlocksBuilder\Blocks;

use Filament\Forms\Components\Builder;
use Filament\Forms\Form;
use SkyRaptor\FilamentBlocksBuilder\Blocks\Contracts\Block;
use SkyRaptor\FilamentBlocksBuilder\Forms;

/**
 * This layout block defines a "container" component.
 */
class Container extends Block
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
        return 'filament-blocks-builder::layout.container';
    }
}