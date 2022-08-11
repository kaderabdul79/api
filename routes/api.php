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
Route::post('/categories/create',[CategoryController::class,'storeCategory']);
Route::get('/categories/{id}',[CategoryController::class,'getCategoryById']);
Route::get('/categories/{id}/edit',[CategoryController::class,'editCategoryById']);
Route::put('/categories/{id}',[CategoryController::class,'updateCategoryById']);
Route::delete('/categories/{id}',[CategoryController::class,'deleteCategoryById']);

// courses
Route::get('/courses',[CourseController::class,'getAllCourses']);
Route::post('/courses/create',[CourseController::class,'storeCourse']);
Route::get('/courses/{id}',[CourseController::class,'getCourseById']);
Route::get('/courses/{id}/edit',[CourseController::class,'editCourseById']);
Route::put('/courses/{id}',[CourseController::class,'updateCourseById']);
Route::delete('/courses/{id}',[CourseController::class,'deleteCourseById']);


