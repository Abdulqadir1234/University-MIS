<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Faculty;
use App\Models\University;

class FacultyFactory extends Factory
{
    protected $model = Faculty::class;

    public function definition(): array
    {
        // Create a related university
        $university = University::factory()->create();

        return [
            'name' => $this->faker->name,
            'university_id' => $university->id, // Assign the created university
        ];
    }
}
