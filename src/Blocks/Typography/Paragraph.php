<?php

namespace SkyRaptor\FilamentBlocksBuilder\Blocks\Typography;

use Filament\Forms\Components;
use Filament\Forms\Components\Builder;
use Filament\Forms\Form;
use SkyRaptor\FilamentBlocksBuilder\Blocks\Contracts\Block;

/**
 * This typography Block defines a paragraph.
 */
class Paragraph extends Block
{
    /**
     * @inheritDoc
     */
    public static function block(Form $form): Builder\Block
    {
        return parent::block($form)->schema([
            Components\MarkdownEditor::make('content')
                ->required(),
        ]);
    }

    public static function view(): string
    {
        return 'filament-blocks-builder::typography.paragraph';
    }
}
