<?php

namespace Tests\SkyRaptor\FilamentBlocksBuilder\Browser;

use Laravel\Dusk\Browser;
use Orchestra\Testbench\Dusk\Options;

class BlocksInputTest extends TestCase
{
     /**
     * Prepare the testing environment web driver options.
     * 
     * @see https://packages.tools/testbench-dusk/the-basic.html#running-with-or-without-ui
     */
    public static function defineWebDriverOptions() 
    {
        Options::withUi();
    }

    /**
     * This test is intended to ensure that nested BlocksInput
     * instances do work and interact as intended.
     */
    function test_nested_builders_interaction()
    {
        $this->browse(function (Browser $browser) {
            /* Authenticate as the default testing User */
            $browser->loginAs($this->user);

            /* Open the testing resource's form */
            $browser->visit('/admin/pages/create');

            /* Add a Card to the BlocksInput */
            $browser->press('Add to');
            $browser->press('Card');

            /* Ensure that the card has been successfully added */
            $browser->assertSee('Card 1');
        });
    }

    /**
     * This test is intended to ensure that nested BlocksInput
     * instances do work and interact as intended.
     */
    function test_nested_builders_save_and_load()
    {
        $this->browse(function (Browser $browser) {
            /* Authenticate as the default testing User */
            $browser->loginAs($this->user);

            /* Open the testing resource's form */
            $browser->visit('/admin/pages/create');

            /* Add a title */
            $browser->waitUntilEnabled('#data\.title')
                ->type('#data\.title', 'Heureka, eine neue Seite!');

            /* Add a Card to the BlocksInput */
            $browser->press('Add to');
            sleep(1);
            $browser->waitForText('Card');
            sleep(1);
            $browser->press('Card');
            sleep(1);

            /* Ensure that the card has been successfully added */
            $browser->assertSee('Card 1');

            /* Add a Heading to the Card's content */
            $browser->press('Add to content');
            sleep(1);
            $browser->waitForText('Heading');
            sleep(1);
            $browser->press('Heading');
            sleep(1);
            $browser->type('input[id$=".data.content"]', 'Das ist eine Überschrift!');
            sleep(1);
            $browser->select('select[id$=".data.level"]', 'h1');
            sleep(1);

            /* Add a paragraph to the Card's content */
            $browser->press('Add to content');
            sleep(1);
            $browser->waitForText('Paragraph');
            sleep(1);
            $browser->press('Paragraph');
            sleep(1);
            $browser->script('document.querySelector(`[ax-load-src*="markdown-editor"]`)._editor.value(`Hallo, Welt!`);');
            sleep(1);

            $browser->press('Create');
            sleep(1);

            $browser->waitForLocation('/admin/pages/1/edit');
            sleep(1);

            $browser->assertSee('Card 1');
            $browser->assertSee('Heading 1');
            $browser->assertValue('input[id$=".data.content"]', 'Das ist eine Überschrift!');
            $browser->assertSee('Paragraph 2');
        });
    }
}