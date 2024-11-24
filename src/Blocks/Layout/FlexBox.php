<?php

namespace SkyRaptor\FilamentBlocksBuilder\Blocks;

use Filament\Forms;
use Filament\Forms\Form;
use SkyRaptor\FilamentBlocksBuilder\Blocks\Contracts\Block;
use SkyRaptor\FilamentBlocksBuilder\Forms\Components\BlocksInput;

/**
 * This layout block defines a "flex-box" component.
 */
class FlexBox extends Block
{
    /**
     * @inheritDoc
     */
    public static function block(Form $form): Forms\Components\Builder\Block
    {
        return parent::block($form)->schema([
            Forms\Components\Select::make('basis')
                ->options([
                    'row',
                    'row-reverse',
                    'column',
                    'column-reverse'
                ]),
            Forms\Components\Select::make('direction')
                ->options([
                    'row',
                    'row-reverse',
                    'column',
                    'column-reverse'
                ]),
            BlocksInput::make('content')
        ]);
    }

    public static function view(): string
    {
        return 'filament-blocks-builder::layout.flex-box';
    }
}