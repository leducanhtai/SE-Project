<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class HeaderNavigationTest extends DuskTestCase
{
    public function test_home_navigation_link(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/') 
                    ->assertSeeLink('Home') 
                    ->clickLink('Home')   
                    ->assertPathIs('/')
                    ->assertSee('AI'); 
        });
    }
}
