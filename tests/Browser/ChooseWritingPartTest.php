<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ChooseWritingPartTest extends DuskTestCase
{
    /** @test */
    public function clicking_each_part_redirects_to_writing_test_index()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('writing.test.part'));

            $links = $browser->elements('a[href="' . route('writing.test.index') . '"]');

            $count = count($links);
            $this->assertEquals(3, $count, "Có 3 link Part trùng href route writing.test.index");

            for ($i = 0; $i < $count; $i++) {
                $browser->visit(route('writing.test.part')); 
                $browser->click('a[href="' . route('writing.test.index') . '"]:nth-of-type(' . ($i + 1) . ')')
                        ->assertRouteIs('writing.test.index')
                        ->assertSee('Choose your question set');
            }
        });
    }
}
