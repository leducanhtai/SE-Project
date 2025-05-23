<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class HomeTest extends DuskTestCase
{
    /** @test */
    public function clicking_start_free_button_redirects_to_dashboard()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/') 
                ->click('a.btn-primary.bg-orange-500.hover\\:bg-orange-600.text-white.font-bold.py-3.px-8.rounded-lg.text-lg') // click vào nút
                ->assertRouteIs('dashboard') 
                ->assertSee('Dashboard'); 
        });
    }
}
