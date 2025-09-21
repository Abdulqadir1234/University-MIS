<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\Faculty;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $faculties = Faculty::all();

        foreach ($faculties as $fac) {
            Department::factory()->count(4)->create([
                'faculty_id' => $fac->id,
                'university_id' => $fac->university_id,
            ]);
        }
    }
}
