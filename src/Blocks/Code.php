<?php

namespace SkyRaptor\FilamentBlocksBuilder\Blocks;

use Filament\Forms;
use Filament\Forms\Form;
use SkyRaptor\FilamentBlocksBuilder\Blocks\Contracts\Block;
use SkyRaptor\FilamentBlocksBuilder\Forms\Components\BlocksInput;

/**
 * This block defines a "code" component.
 */
class Code extends Block
{
    /**
     * @inheritDoc
     */
    public static function block(Form $form): Forms\Components\Builder\Block
    {
        return parent::block($form)->schema([
            Forms\Components\TextInput::make('language')
                ->required(),
            BlocksInput::make('code')
                ->required()
        ]);
    }

    public static function view(): string
    {
        return 'filament-blocks-builder::code';
    }
}