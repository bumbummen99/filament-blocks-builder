<?php

namespace SkyRaptor\FilamentBlocksBuilder\Blocks\Typography;

use Filament\Forms\Components;
use Filament\Forms\Components\Builder;
use Filament\Forms\Form;
use SkyRaptor\FilamentBlocksBuilder\Blocks\Contracts\HTMLBlock;

/**
 * This typography Block defines a heading.
 */
class Heading extends HTMLBlock
{
    /**
     * @inheritDoc
     */
    public static function block(Form $form): Builder\Block
    {
        return parent::block($form)->schema([
            Components\TextInput::make('content')
                ->required(),
            Components\Select::make('level')
                ->options([
                    'h1' => 'Heading 1',
                    'h2' => 'Heading 2',
                    'h3' => 'Heading 3',
                    'h4' => 'Heading 4',
                    'h5' => 'Heading 5',
                    'h6' => 'Heading 6',
                ])
                ->required()
        ])->columns(2);
    }

    public static function view(): ?string
    {
        return 'filament-blocks-builder::typography.heading';
    }
}
