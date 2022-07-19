<?php

namespace App\Http\Controllers\Api;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    // getAllCategories list
    public function getAllCourses(){
        $courses = Course::all();
        return response()->json([
            'status' => true,
            'categories' => $courses
        ]);
    }

    // getCategoriesById for a single category
    public function getCourseById(Request $request){
        $course = Course::findOrFail($request->id);
        return response()->json([
            'status' => true,
            'category' => $course
        ]);
    }

    // deleteCategoryById
    public function deleteCourseById(Request $request){
        $course = Course::findOrFail($request->id);
        $course->delete();
        return response()->json([
            'status' => true,
            'message' => 'deleted'
        ]);
    }
}
