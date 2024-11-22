<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Education>
 */
class EducationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

        public function definition(): array
        {
            return [
                'name' => fake()->jobTitle,
                'date' => fake()->dateTime(),
                'place' => fake()->city,
                'description' => fake()->text(400),
            ];
        }

}
