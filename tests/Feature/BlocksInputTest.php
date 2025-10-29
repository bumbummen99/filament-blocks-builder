<?php

namespace Tests\SkyRaptor\FilamentBlocksBuilder\Feature;

use Filament\Forms\Components\Component;
use Livewire\Features\SupportTesting\Testable;
use Livewire\Livewire;
use SkyRaptor\FilamentBlocksBuilder\Blocks;
use SkyRaptor\FilamentBlocksBuilder\Forms\Components\BlocksInput;
use Workbench\App\Filament\Resources\PageResource\Pages;

class BlocksInputTest extends TestCase
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
                        'content' => []
                    ],
                    'type' => Blocks\Card::class
                ]
            ]
        ]);

        /* Check the second BlockBuilder */
        $nestedBuilder = $checkBuilder('data.content.0.data.content');

        $parentChildComponents = $parentBuilder->getChildComponents();
        $nestedChildComponents = $nestedBuilder->getChildComponents();

        /* Compare both arrays */
        $this->assertCount(count($parentChildComponents), $nestedChildComponents);

        $getBlockName = function(\Filament\Forms\Components\Builder\Block $block) {
            return $block->getName();
        };

        /* Compare object attributes */
        foreach ($parentChildComponents as $index => $component) {
            // Compare the Block name / type
            $this->assertEquals(
                $getBlockName($component),
                $getBlockName($nestedChildComponents[$index]),
                "Block at index {$index} differs."
            );
        }
    }

    protected function getFormComponent(Testable $page, string $componentKey, string $formName = 'form'): ?Component
    {
        /** @var ComponentContainer $form */
        $form = $page->instance()->{$formName};
        return $form->getFlatComponentsByKey(withHidden: true)[$componentKey] ?? null;
    }
}