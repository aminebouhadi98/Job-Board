<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = \App\Models\User::inRandomOrder()->first() ?? \App\Models\User::factory()->create();
        $job = \App\Models\Job::inRandomOrder()->first() ?? \App\Models\Job::factory()->create();
        return [
            'job_id' => $job->id,
            'user_id' => $user->id,
            'cover_letter' => $this->faker->paragraph(),
            'cv_path' => $this->faker->filePath(),
        ];
    }
}
