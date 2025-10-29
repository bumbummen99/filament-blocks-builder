<?php

namespace SkyRaptor\FilamentBlocksBuilder\Blocks\Typography;

use Filament\Forms\Components;
use Filament\Forms\Components\Builder;
use Filament\Schemas\Schema;
use SkyRaptor\FilamentBlocksBuilder\Blocks\Contracts\HTMLBlock;

/**
 * This typography Block defines a paragraph.
 */
class Paragraph extends HTMLBlock
{
    /**
     * @inheritDoc
     */
    public static function block(Schema $schema): Builder\Block
    {
        return parent::block($schema)->schema([
            Components\MarkdownEditor::make('content')
                ->required(),
        ]);
    }

    public static function view(): ?string
    {
        return 'filament-blocks-builder::typography.paragraph';
    }
}
