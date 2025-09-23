<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\University;

class UniversityFactory extends Factory
{
    protected $model = University::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company . ' University',
            'location' => $this->faker->city,
        ];
    }
}
