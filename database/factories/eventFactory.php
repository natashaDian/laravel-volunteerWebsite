<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event;
use App\Models\Company;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\event>
 */
class eventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'event_code' => 'E' . $this->faker->unique()->numerify('###'),
            'company_id' => Company::inRandomOrder()->first()->id,
            'title' => $this->faker->catchPhrase(),
            'description' => $this->faker->paragraph(),
            'location' => $this->faker->streetAddress() . ', ' .
               $this->faker->city() . ', ' .
               $this->faker->state() . ', Indonesia',
            'date' => $this->faker->dateTimeBetween('+1 week', '+3 months')->format('Y-m-d'),
            'time' => $this->faker->time('H:i'),
            'quota' => $this->faker->numberBetween(20, 200),
        ];
    }
}
