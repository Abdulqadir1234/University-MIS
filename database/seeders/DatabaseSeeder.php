<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\University;
use App\Models\Faculty;
use App\Models\Department;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create 3 universities
        University::factory(3)->create()->each(function ($university) {

            // Each university has 2-4 faculties
            $faculties = Faculty::factory(rand(2, 4))->create([
                'university_id' => $university->id,
            ]);

            // Each faculty has 2-5 departments
            $faculties->each(function ($faculty) use ($university) {
                Department::factory(rand(2,5))->create([
                    'university_id' => $university->id,
                    'faculty_id' => $faculty->id,
                ]);
            });
        });
    }
}
