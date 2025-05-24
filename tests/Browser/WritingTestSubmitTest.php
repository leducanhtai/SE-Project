<?php

namespace Tests\Browser;

use App\Models\User;
use App\Models\WritingTest;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class WritingTestSubmitTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_writing_textarea_and_submit_flow()
    {
        $user = User::factory()->create();
        $writingTest = WritingTest::factory()->create([
            'title' => 'Test bài viết',
            'task_content' => 'Viết đoạn văn mẫu',
            'time_limit' => 40,
        ]);

        $this->browse(function (Browser $browser) use ($user, $writingTest) {
            $browser->loginAs($user)
                ->visit(route('writing.test.show', ['id' => $writingTest->id]))
                ->assertSee($writingTest->task_content)

                ->waitFor('#writingAnswer', 5)
                ->type('#writingAnswer', 'Đây là bài viết thử nghiệm cho Laravel Dusk.')

                ->press('SUBMIT')
                ->waitFor('#confirmModal', 3)
                ->assertVisible('#confirmModal')
                ->assertSee('Bạn có chắc chắn muốn nộp bài?')

                ->press('#cancelSubmit')
                ->pause(500)
                ->assertMissing('#confirmModal')

                ->press('SUBMIT')
                ->waitFor('#confirmModal', 3)
                ->assertVisible('#confirmModal')


                ->press('#confirmSubmit')

                ->waitUsing(10, 500, function () use ($browser) {
                    return preg_match('/\/submission\/\d+\/processing$/', $browser->driver->getCurrentURL());
                })

                ->assertSee('Grading');
        });
    }
}
