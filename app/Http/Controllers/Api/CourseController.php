<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    
    // get All Course list
    public function getAllCourses(){
        try{
            $courses = Course::all()->load('category');
            return send_response("fetch all courses data!",$courses);
        }catch(Exception $e){
            return send_error('No Data Found!',$e->getCode());
        }
    }
    
    // insert course data
    public function storeCourse(Request $request){
        $rules = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required',
            'code' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'status' => 'required',
            'price' => 'required',
        ]);

        if($rules->fails()){
            return send_error('Validation Error',$rules->messages(),$code = 422);
        }

        try{
            $course = Course::create([
                'name' => $request->name,
                'code' => $request->code,
                'category_id' => $request->category_id,
                'description' => $request->description,
                'status' => $request->status,
                'price' => $request->price,
            ]);

            return send_response("succesfully Inserted!",$course);

        }catch(Exception $e){
            return send_error($e->getMessage(),$e->getCode());
        }
    }

    // getCourseById for a single Course
    public function getCourseById($id){
        try{
            $course = Course::findOrFail($id)->load('category');
            return send_response("fetch course data!",$course);
        }catch(Exception $e){
            return send_error('No Data Found!',$e->getCode());
        }
    }

    // getCourseById for a single Course
    public function editCourseById($id){
        try{
            $course = Course::findOrFail($id)->load('category');
            return send_response("fetch course data!",$course);
        }catch(Exception $e){
            return send_error('No Data Found!',$e->getCode());
        }
    }

    // updateCourseById for a single Course
    public function updateCourseById(Request $request,$id){
        $rules = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required',
            'code' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'status' => 'required',
            'price' => 'required',
        ]);

        if($rules->fails()){
            return send_error('Validation Error',$rules->messages(),$code = 422);
        }

        try{
            $course = Course::findOrFail($id)->load('category');
            $course->name = $request->name;
            $course->code = $request->code;
            $course->category_id = $request->category_id;
            $course->description = $request->description;
            $course->status = $request->status;
            $course->price = $request->price;
            $course->save();

            return send_response("succesfully updated!",$course);

        }catch(Exception $e){
            return send_error($e->getMessage(),$e->getCode());
        }
    }

    // deleteCourseById
    public function deleteCourseById($id){
        try{
            $course = Course::findOrFail($id);
            $course->delete();
            return send_response("Successfull Deleted!");
        }catch(Exception $e){
            return send_error('No Data Found!',$e->getCode());
        }
    }
}
