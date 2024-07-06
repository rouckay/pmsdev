<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\tasks>
 */
class TasksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'project_id' => 1,
            'description' => fake()->realText(),
            'assigned_to' => 1,
            'percentage' => fake()->randomDigit(),
            'due_date' => fake()->date(),
            'status' => fake()->boolean(),
        ];
    }
}
