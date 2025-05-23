<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WritingSubmission>
 */
class WritingSubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      return [
        'test_id' => \App\Models\WritingTest::factory(), // Tạo test liên kết
        'content' => $this->faker->paragraphs(5, true),
        'word_count' => 100,
        'submitted_at' => now(),
    ];
    }
}
