<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class WritingTestListTest extends DuskTestCase
{
    /** @test */
    public function test_page_loads()
{
    $this->browse(function (Browser $browser) {
        $browser->visit(route('writing.test.index'))
                ->assertSee('Choose your question set');
    });
}


    /** @test */
    public function test_navigation_buttons_work()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('writing.test.index'))
                    ->waitFor('#nextBtn', 10)
                    ->press('#nextBtn')
                    ->pause(1000)
                    ->press('#prevBtn')
                    ->pause(1000);
        });
    }
}
