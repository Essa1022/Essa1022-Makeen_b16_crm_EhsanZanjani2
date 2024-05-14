<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->title(),
            'description' => $this->faker->text(50),
            'taskable_type' => $this->faker->randomElement([User::class, Team::class]),
            'taskable_id' => function () {
                if ($this->faker->randomElement([User::class, Team::class]) === User::class)
                {
                    return User::all()->random()->id;
                }
                else
                {
                    return Team::all()->random()->id;
                }
            },
        ];
    }
}
