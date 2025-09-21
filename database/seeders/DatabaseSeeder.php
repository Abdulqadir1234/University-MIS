<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\University;
use App\Models\Faculty;
use App\Models\Department;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create 5 Universities
        University::factory(5)->create()->each(function($university) {

            // Each University has 3-5 Faculties
            $faculties = Faculty::factory(rand(3,5))->create([
                'university_id' => $university->id
            ]);

            // Each University has 3-5 Departments, each linked to a random faculty
            Department::factory(rand(3,5))->create([
                'university_id' => $university->id,
                'faculty_id' => $faculties->random()->id
            ]);
        });

        $this->call(RolePermissionSeeder::class);

        // Admin user
        $admin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('admin');

        // Teacher user
        $teacher = User::factory()->create([
            'name' => 'Teacher John',
            'email' => 'teacher@example.com',
            'password' => bcrypt('password'),
        ]);
        $teacher->assignRole('teacher');

        // Normal user
        $user = User::factory()->create([
            'name' => 'Viewer User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole('user');
    }
}
