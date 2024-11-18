<?php

namespace Tests\SkyRaptor\FilamentBlocksBuilder\Feature;

use Filament\Forms\Components\Component;
use Livewire\Features\SupportTesting\Testable;
use Livewire\Livewire;
use SkyRaptor\FilamentBlocksBuilder\Blocks;
use SkyRaptor\FilamentBlocksBuilder\Forms\Components\BlocksInput;
use Tests\SkyRaptor\FilamentBlocksBuilder\FeatureTestCase;
use Workbench\App\Filament\Resources\PageResource\Pages;

class BlocksInputTest extends FeatureTestCase
{
    /**
     * This test is intended to ensure that nested BlockBuilder instances
     * do inherit their blocks from the closest BlockBuilder parent.
     */
    function test_nested_builders_inherit_blocks()
    {
        /* Initialize the Filament PHP Resource's create Page to be tested */
        $page = Livewire::test(Pages\CreatePage::class);

        /* Helper to check that a Component exists and is a BlockBuilder */
        $checkBuilder = function (string $componentKey) use ($page) {
            /* Check the first BlockBuilder instance exists */
            $page->assertFormComponentExists($componentKey);

            /* Get a reference to the first BlockBuilder */
            $builder = $this->getFormComponent($page, $componentKey);

            /* Check the first BlockBuilder's type */
            $this->assertInstanceOf(BlocksInput::class, $builder);

            return $builder;
        };

        /* Check the first BlockBuilder */
        $parentBuilder = $checkBuilder('data.content');

        /* Fill the page's form, add a Card and some content Blocks. */
        $page->fillForm([
            /* Set the Page's title */
            'title' => 'Hallo, Welt!',

            /* Set the page's BlockBuilder content */
            'content' => [
                /* Add a Card as a nested BlockBuilder instance */
                [
                    'data' => [
                        'content' => [
                            /* Add a Heading Block as the Card's title */
                            [
                                'data' => [
                                    'content' => 'Das ist eine Card!',
                                    'level'   => 'h2'
                                ],
                                'type' => Blocks\Typography\Heading::class
                            ],
                            /* Add a Paragraph Block as the Card's content */
                            [
                                'data' => [
                                    'content' => 'Dies ist ein normaler Textblock und Inhalt der Card.'
                                ],
                                'type' => Blocks\Typography\Paragraph::class
                            ]
                        ]
                    ],
                    'type' => Blocks\Layout\Card::class
                ]
            ]
        ]);

        /* Check the second BlockBuilder */
        $nestedBuilder = $checkBuilder('data.content.0.data.content');

        /* Ensure the BlocksBuilder inherited the blocks from it's closest parent */
        $this->assertEquals($parentBuilder->getChildComponents(), $nestedBuilder->getChildComponents());
    }

    protected function getFormComponent(Testable $page, string $componentKey, string $formName = 'form'): ?Component
    {
        /** @var ComponentContainer $form */
        $form = $page->instance()->{$formName};
        return $form->getFlatComponentsByKey(withHidden: true)[$componentKey] ?? null;
    }
}