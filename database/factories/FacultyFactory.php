<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\University;

class FacultyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word . ' Faculty',
            'university_id' => University::factory(),
        ];
    }
}
