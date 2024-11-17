<?php

namespace SkyRaptor\FilamentBlocksBuilder\Forms\Components;

use Closure;
use Filament\Forms\Components\Builder;

final class BlocksInput extends Builder
{
    /**
     * Determines if blocks should be inherited from the closest parent BlocksInput.
     */
    protected bool $inherit = true;

    protected function setUp(): void
    {
        parent::setUp();

        if ($this->inherit) {
            $this->inheritBlocks();
        }
    }

    /**
     * This fluent method can be used to toggle blocks inheritance.
     */
    public function inherit(bool $state = true): static
    {
        $this->inherit = $state;

        return $this;
    }

    /**
     * This method does find the first "parent" 
     * BlocksInput and inherit it's blocks 
     */
    public function inheritBlocks()
    {
        /* Use a Closure to inherit blocks lazy */
        $this->childComponents(function () {
            $current = $this;

            /* Iterate this BlockInput's parents */
            while ($parent = $current->getContainer()->getParentComponent()) {
                /* Determine if the parent is a BlocksInput */
                if ($parent instanceof static) {
                    /* Inherit the blocks */
                    $this->blocks($parent->getCildComponents());

                    /* Stop the loop */
                    break;
                } else {
                    /* Continue using the parent */
                    $current = $parent;
                }
            }
        });
    }

    /**
     * This method allows public access to the childComponents 
     * member without evaluating it's value beforehand.
     */
    public function getCildComponents(): array | Closure
    {
        return $this->childComponents;
    }
}