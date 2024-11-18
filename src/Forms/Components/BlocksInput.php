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
     * This method does find the first "parent" 
     * BlocksInput and inherit it's blocks 
     */
    protected function inheritBlocks()
    {
        /* Inherit possible parent Blocks */
        $this->childComponents(
            /* Use a Closure to prevent accessing the Component's Container before initialization */
            fn () => $this->getParentBlocksInput()?->getChildComponents()
        );
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
     * This helper method finds the closest parent 
     * BlocksInput component and returns it.
     */
    protected function getParentBlocksInput(): ?static
    {
        $current = $this;

        /* Iterate this BlockInput's parents */
        while ($parent = $current->getContainer()->getParentComponent()) {
            /* Determine if the parent is a BlocksInput */
            if ($parent instanceof static) {
                return $parent;
            } else {
                /* Continue search with the parent */
                $current = $parent;
            }
        }

        return null;
    }
}