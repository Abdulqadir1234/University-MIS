<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faculty;
use App\Models\University;

class FacultySeeder extends Seeder
{
    public function run(): void
    {
        $universities = University::all();

        foreach ($universities as $uni) {
            Faculty::factory()->count(3)->create([
                'university_id' => $uni->id,
            ]);
        }
    }
}
