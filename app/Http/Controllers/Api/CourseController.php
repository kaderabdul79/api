<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
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

    // getAllCourse list
    public function getAllCourses(){
        $courses = Course::all()->load('category');
        return send_response("fetch all courses data!",$courses);
    }

    // getCourseById for a single Course
    public function getCourseById(Request $request){
        try{
            $course = Course::findOrFail($request->id)->load('category');
            return send_response("fetch course data!",$course);
        }catch(Exception $e){
            return send_error('No Data Found!',$e->getCode());
        }
    }

    // deleteCourseById
    public function deleteCourseById(Request $request){
        try{
            $course = Course::findOrFail($request->id);
            $course->delete();
            return send_response("Successfull Deleted!");
        }catch(Exception $e){
            return send_error('No Data Found!',$e->getCode());
        }
    }
}
