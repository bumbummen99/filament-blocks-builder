<?php

namespace Tests\SkyRaptor\FilamentBlocksBuilder\Feature;

use Livewire\Livewire;
use SkyRaptor\FilamentBlocksBuilder\Blocks;
use Tests\SkyRaptor\FilamentBlocksBuilder\FeatureTestCase;
use Workbench\App\Filament\Resources\PageResource\Pages;

class BlocksInputTest extends FeatureTestCase
{
    function test_page_title_can_be_edited()
    {
        /* Initialize the Filament PHP Resource's create Page to be tested */
        $page = Livewire::test(Pages\CreatePage::class);

        /* Test that the title can be set */
        $page->set('data.title', 'Hello World');
        $page->assertSet('data.title', 'Hello World');
    }

    function test_page_content_can_be_edited()
    {
        /* Initialize the Filament PHP Resource's create Page to be tested */
        $page = Livewire::test(Pages\CreatePage::class);

        /* Insert a Paragraph */
        $page->set('data.content', [
            [
                'data' => [
                    'content' => 'Schön ist es auf der Welt zu sein sagt die Biene zu dem Stachelschwein.'
                ],
                'type' => Blocks\Typography\Paragraph::class
            ]
        ]);
        $page->assertSet('data.content', [
            [
                'data' => [
                    'content' => 'Schön ist es auf der Welt zu sein sagt die Biene zu dem Stachelschwein.'
                ],
                'type' => Blocks\Typography\Paragraph::class
            ]
        ]);
    }

    function test_page_can_be_created()
    {
        /* Initialize the Filament PHP Resource's create Page to be tested */
        $page = Livewire::test(Pages\CreatePage::class);

        /* Set basic content for the Page */
        $page->set('data.title', 'Hello World');
        $page->set('data.content', [
            [
                'data' => [
                    'content' => 'Schön ist es auf der Welt zu sein sagt die Biene zu dem Stachelschwein.'
                ],
                'type' => Blocks\Typography\Paragraph::class
            ]
        ]);

        /* Submit the form and create the Resource */
        $page->call('create');

        /* Ensure that the Page has been created successfully */
        $page->assertHasNoFormErrors();

        /* Ensure the page has been created */
        $this->assertDatabaseCount('pages', 1);
    }
}