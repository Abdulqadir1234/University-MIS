<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\University;
use App\Models\Faculty;

class DepartmentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word . ' Department',
            'university_id' => University::factory(),
            'faculty_id' => Faculty::factory(),
        ];
    }
}
