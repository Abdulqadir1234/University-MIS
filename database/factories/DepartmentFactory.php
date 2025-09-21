<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\University;

class DepartmentFactory extends Factory
{
    protected $model = Department::class;

    public function definition(): array
    {
        // Create or get a faculty with its university
        $faculty = Faculty::factory()->create();

        return [
            'name' => $this->faker->unique()->word . ' Department',
            'faculty_id' => $faculty->id,
            'university_id' => $faculty->university_id, // Match university to faculty
        ];
    }
}
