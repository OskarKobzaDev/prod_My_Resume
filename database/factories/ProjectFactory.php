<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'descriptionShort' => $this->faker->text(80),
            'pngPath' => $this->faker->imageUrl(),
            'descriptionLong' => $this->faker->text(400),
            'pathGitHub'=> $this->faker->url(),
            'pathUrl'=> $this->faker->url(),
        ];
    }
}
