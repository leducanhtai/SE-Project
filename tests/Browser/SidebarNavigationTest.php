<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class SidebarNavigationTest extends DuskTestCase
{
    /** @test */
    public function it_shows_correct_active_link_on_dashboard()
{
    $this->browse(function (Browser $browser) {
        $user = User::factory()->create();

        $browser->loginAs($user)
                ->visitRoute('dashboard')
                ->assertPresent('aside nav a[href="' . route('dashboard') . '"].bg-white.text-\\[\\#ffb700\\]')
                ->assertSee('Dashboard');
    });
}
/** @test */
public function it_shows_correct_active_link_on_writing_part()
{
    $this->browse(function (Browser $browser) {
        $user = User::factory()->create();

        $browser->loginAs($user)
                ->visitRoute('writing.test.part')
                ->assertPresent('aside nav a[href="' . route('writing.test.part') . '"].bg-\\[\\#889cbca8\\]')
                ->assertSee('your');
    });
}


    /** @test */
    public function it_shows_hover_effect_on_non_active_links()
    {
        $this->browse(function (Browser $browser) {
            $user = User::factory()->create();

            $browser->loginAs($user)
                    ->visitRoute('dashboard')
                    ->assertPresent('aside nav a[href="' . route('writing.test.part') . '"].hover\\:bg-\\[\\#ffb700\\]');
        });
    }
}
