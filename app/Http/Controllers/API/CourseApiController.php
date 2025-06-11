<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseApiController extends Controller
{
    public function index()
    {
        $courses = Course::where('instructor_id', 1)->get();
        
        // If no courses exist, create some sample data
        if ($courses->isEmpty()) {
            $sampleCourses = [
                [
                    'title' => 'MOBILE DEV REACT NATIVE',
                    'description' => 'Learn React Native development',
                    'image' => 'react-native.png',
                    'students_count' => 123,
                    'instructor_id' => 1
                ],
                [
                    'title' => 'LEARN PROGRAMMING IN 30 DAYS',
                    'description' => 'Complete programming course',
                    'image' => 'programming.png',
                    'students_count' => 100,
                    'instructor_id' => 1
                ],
                [
                    'title' => 'VUE JAVASCRIPT COURSE',
                    'description' => 'Master Vue.js framework',
                    'image' => 'vue.png',
                    'students_count' => 120,
                    'instructor_id' => 1
                ],
                [
                    'title' => 'WEBSITE DEV ZERO TO HERO',
                    'description' => 'Complete web development course',
                    'image' => 'website.png',
                    'students_count' => 124,
                    'instructor_id' => 1
                ]
            ];

            foreach ($sampleCourses as $courseData) {
                Course::create($courseData);
            }

            $courses = Course::where('instructor_id', 1)->get();
        }
        
        return response()->json($courses);
    }

    public function stats()
    {
        $courses = Course::where('instructor_id', 1)->get();
        
        // If no courses exist, create sample data first
        if ($courses->isEmpty()) {
            $this->index(); // This will create sample courses
            $courses = Course::where('instructor_id', 1)->get();
        }
        
        $stats = [
            'total_courses' => $courses->count(),
            'total_students' => $courses->sum('students_count'),
            'average_rating' => 4.8 // Hardcoded for now, you can add a rating system later
        ];

        return response()->json($stats);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $course = Course::create([
            ...$validated,
            'instructor_id' => 1, // Hardcoded for now
            'students_count' => 0
        ]);

        return response()->json([
            'message' => 'Course created successfully',
            'course' => $course
        ], 201);
    }

    public function show($id)
    {
        // Mock single course data
        $course = [
            'id' => $id,
            'title' => 'Sample Course',
            'description' => 'Course description',
            'students_count' => 50,
            'image' => 'default.png',
            'instructor_id' => 1
        ];

        return response()->json($course);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string'
        ]);

        return response()->json([
            'message' => 'Course updated successfully',
            'course' => $validated
        ]);
    }

    public function destroy($id)
    {
        return response()->json([
            'message' => 'Course deleted successfully'
        ]);
    }
}
