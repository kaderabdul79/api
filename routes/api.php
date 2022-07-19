<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\CategoryController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// categories
Route::get('/categories',[CategoryController::class,'getAllCategories']);
Route::get('/categories/{id}',[CategoryController::class,'getCategoryById']);
Route::delete('/categories/{id}',[CategoryController::class,'deleteCategoryById']);

// courses
Route::get('/courses',[CourseController::class,'getAllCourses']);
Route::get('/courses/{id}',[CourseController::class,'getCourseById']);
Route::delete('/courses/{id}',[CourseController::class,'deleteCourseById']);

