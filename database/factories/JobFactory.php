<?php

namespace Database\Factories;
use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    protected $model = Job::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = \App\Models\User::inRandomOrder()->first() ?? \App\Models\User::factory()->create();
        return [
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->paragraph(),
            'location' => $this->faker->city(),
            'contract_type' => $this->faker->randomElement(['full-time', 'part-time', 'contract', 'temporary']),
            'salary' => $this->faker->numberBetween(30000, 120000),
            'user_id' => $user->id,
        ];
    }
}
