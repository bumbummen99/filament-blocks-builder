<?php

namespace Tests\SkyRaptor\FilamentBlocksBuilder\Feature;

use Composer\Semver\Semver;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\App;
use Livewire\Features\SupportTesting\Testable;
use Livewire\Livewire;
use SkyRaptor\FilamentBlocksBuilder\Blocks;
use SkyRaptor\FilamentBlocksBuilder\Forms\Components\BlocksInput;
use Workbench\App\Filament\Resources\Pages\Pages;

class BlocksInputTest extends TestCase
{
    /**
     * This test is intended to ensure that nested BlockBuilder instances
     * do inherit their blocks from the closest BlockBuilder parent.
     */
    function test_nested_builders_inherit_blocks()
    {
        // Initialize the Filament PHP Resource's create Page to be tested
        $page = Livewire::test(Pages\CreatePage::class);

        // Helper to check that a Component exists and is a BlockBuilder
        $checkBuilder = function (string $componentKey) use ($page) {
            // Check the first BlockBuilder instance exists
            $page->assertSchemaComponentExists($componentKey);

            // Get a reference to the BlockBuilder instance
            $component = $this->getFormComponent($page->instance(), $componentKey);

            // Verify the instance's type
            $this->assertInstanceOf(BlocksInput::class, $component);

            return $component;
        };

        // Check the first BlockBuilder
        $parentBuilder = $checkBuilder('content');

        // Fill the page's form, add a Card and some content Blocks.
        $page->fillForm([
            'title' => 'Hallo, Welt!',
            'content' => [
                // Add a Card as a nested BlockBuilder instance
                [
                    'data' => [
                        'content' => []
                    ],
                    'type' => Blocks\Card::class
                ]
            ]
        ]);

        // Check the second BlockBuilder
        $nestedBuilder = $checkBuilder('content.0.data.content');

        $parentChildComponents = $parentBuilder->getChildComponents();
        $nestedChildComponents = $nestedBuilder->getChildComponents();

        // Compare both arrays
        $this->assertCount(count($parentChildComponents), $nestedChildComponents);

        $getBlockName = function (\Filament\Forms\Components\Builder\Block $block) {
            return $block->getName();
        };

        // Compare object attributes
        foreach ($parentChildComponents as $index => $component) {
            // Compare the Block name / type
            $this->assertEquals(
                $getBlockName($component),
                $getBlockName($nestedChildComponents[$index]),
                "Block at index {$index} differs."
            );
        }
    }

    /**
     * Helper to try to get a Component from an CreateRecord's or EditRecord's form.
     * 
     * @param CreateRecord|EditRecord $page 
     * @param string $componentKey 
     * @return null|Component 
     */
    protected function getFormComponent(CreateRecord|EditRecord $page, string $componentKey): ?Component
    {
        return $page->form->getFlatComponents(withHidden: true)[$componentKey] ?? null;
    }
}
