<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Department;
use App\Models\Faculty;

class DepartmentFactory extends Factory
{
    protected $model = Department::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word . ' Department',
            'university_id' => Faculty::factory()->create()->university_id,
            'faculty_id' => Faculty::factory(),
        ];
    }
}
