<?php

namespace Workbench\App\Filament\Resources\Pages\Schemas;

use Filament\Forms;
use Filament\Schemas;
use Filament\Schemas\Schema;
use SkyRaptor\FilamentBlocksBuilder\Blocks;
use SkyRaptor\FilamentBlocksBuilder\Forms\Components\BlocksInput;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Schemas\Components\Section::make()
                    ->heading('Blocks Builder')
                    ->schema([
                        BlocksInput::make('content')
                            ->label('')
                            ->blocks(fn() => [
                                Blocks\Card::block($schema),
                                Blocks\Typography\Heading::block($schema),
                                Blocks\Typography\Paragraph::block($schema)
                            ])
                    ])
            ]);
    }
}
