<?php

namespace Tests\Feature;

use Tests\TestCase;

class OverviewViewTest extends TestCase
{
    /**
     * Test view renders with given submission data.
     *
     * @return void
     */
    public function test_overview_page_renders_correctly()
    {

        $submission = (object) [
            'ai_score' => 0.85,
            'score_change' => 0.05,
            'score_increased' => true,
            'coherence_score' => 7,
            'vocabulary_score' => 8,
            'grammar_score' => 6,
            'ai_feedback' => 'Your writing coherence is excellent.',
            'highlightedContent' => '<p>Some feedback with <span class="span-desc" data-tooltip="Tooltip text here">highlight</span>.</p>',
        ];

        $response = $this->view('submissions.show', ['submission' => $submission, 'highlightedContent' => $submission->highlightedContent]);

        $response->assertSee('summary score');
        $response->assertSee('0%'); 
        $response->assertSee('Your writing coherence is excellent.');
        $response->assertSee('highlight');

        $response->assertSee('pie-chart');
        $response->assertSee('bar-chart');
        $response->assertSee('span-desc');

        $response->assertSee('up.svg');

        $response->assertSee(route('writing.test.index'));
    }
}
