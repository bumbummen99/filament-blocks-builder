<?php

namespace Tests\SkyRaptor\FilamentBlocksBuilder\Feature;

use Illuminate\Support\Facades\Blade;
use SkyRaptor\FilamentBlocksBuilder\Blocks;

class BlocksRendererTest extends TestCase
{
    /**
     * This test is intended to ensure that the 
     * BlocksRenderer does behave as intended.
     */
    function test_blocks_renderer_is_working()
    {
        // Define the test BlocksInput data
        $data = [
            [
                'data' => [
                    'content' => [
                        [
                            'data' => [
                                'content' => 'Das ist eine Card!',
                                'level'   => 'h2'
                            ],
                            'type' => Blocks\Typography\Heading::class
                        ],
                        [
                            'data' => [
                                'content' => 'Das ist ein Paragraph!',
                            ],
                            'type' => Blocks\Typography\Paragraph::class
                        ],
                    ],
                ],
                'type' => Blocks\Card::class
            ]
        ];

        // Render using the custom Blade directive
        $output = Blade::render(<<<'blade'
            @blocks($data)
        blade, [
            'data' => $data
        ]);

        $expected = '<div class="mx-auto">
    <div class="p-6">
        <h2 class="font-bold leading-tight font-2xl">Das ist eine Card!</h2><p>Das ist ein Paragraph!</p>    <div>
</div>';
        $this->assertEquals($expected, $output);
    }
}
