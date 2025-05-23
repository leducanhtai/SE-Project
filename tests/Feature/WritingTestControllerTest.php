<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\WritingTest;

class WritingTestControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_displays_task2_writing_tests()
    {
        $task2Test = WritingTest::factory()->create(['task' => 'task2']);
        WritingTest::factory()->create(['task' => 'task1']); // should be excluded

        $response = $this->get(route('writing.test.index'));

        $response->assertStatus(200);
        $response->assertViewIs('writing.index');
        $response->assertViewHas('writingTests', function ($tests) use ($task2Test) {
            return $tests->count() === 1 && $tests->first()->is($task2Test);
        });
    }

    public function test_show_displays_writing_test()
    {
        $test = WritingTest::factory()->create();

        $response = $this->get(route('writing.test.show', ['id' => $test->id]));

        $response->assertStatus(200);
        $response->assertViewIs('writing.show');
        $response->assertViewHas('writingTest', function ($viewTest) use ($test) {
            return $viewTest->is($test);
        });
    }
}
