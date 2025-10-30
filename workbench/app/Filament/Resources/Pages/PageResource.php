<?php

namespace Workbench\App\Filament\Resources\Pages;

use Workbench\App\Filament\Resources\Pages\Pages\CreatePage;
use Workbench\App\Filament\Resources\Pages\Pages\EditPage;
use Workbench\App\Filament\Resources\Pages\Pages\ListPages;
use Workbench\App\Filament\Resources\Pages\Schemas\PageForm;
use Workbench\App\Filament\Resources\Pages\Tables\PagesTable;
use Workbench\App\Models\Page;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return PageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PagesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPages::route('/'),
            'create' => CreatePage::route('/create'),
            'edit' => EditPage::route('/{record}/edit'),
        ];
    }
}
