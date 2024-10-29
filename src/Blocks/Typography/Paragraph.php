<?php

namespace SkyRaptor\FilamentBlocksBuilder\Blocks\Typography;

use Closure;
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
    public static function block(): Closure
    {
        return fn (Form $form) => Builder\Block::make(static::class)
            ->label('Paragraph')
            ->schema([
                Components\Textarea::make('content')
                    ->required(),
            ]);
    }

    public static function view(): string
    {
        return 'filament-blocks-builder::typography.paragraph';
    }
}