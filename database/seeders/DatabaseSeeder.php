<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create(['name' => 'Admin', 'email' => 'admin@lms.test', 'role' => 'admin']);

        $instructor = User::factory()->create(['name' => 'Test Instructor', 'email' => 'instructor@lms.test', 'role' => 'instructor']);

        $student = User::factory()->create(['name' => 'Student One', 'email' => 'student@lms.test', 'role' => 'student']);

        $catalog = [
            'Beginner Photography' => ['Understanding Your Camera', 'Light and Exposure', 'Composition Basics', 'Portrait Photography', 'Editing Your Photos'],
            'Everyday Spanish' => ['Greetings and Introductions', 'Numbers and Time', 'Ordering Food', 'Asking for Directions', 'Simple Conversations'],
            'Personal Finance Basics' => ['Budgeting 101', 'Saving Strategies', 'Understanding Debt', 'Intro to Investing', 'Planning for the Future'],
        ];

        foreach ($catalog as $title => $lessons) {
            $course = Course::create([
                'instructor_id' => $instructor->id,
                'title' => $title,
                'description' => "A beginner-friendly course: $title.",
                'published' => true,
            ]);

            foreach ($lessons as $index => $lessonTitle) {
                $course->lessons()->create([
                    'title' => $lessonTitle,
                    'position' => $index + 1,
                ]);
            }
        }

        $student->enrolledCourses()->attach(Course::first()->id);
    }
}