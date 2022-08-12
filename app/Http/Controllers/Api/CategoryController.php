<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    
    // get All Categories list
    public function getAllCategories(){
        try{
            $categories = Category::all()->load('courses');
            return send_response("fetch all categories!",$categories);
        }catch(Exception $e){
            return send_error('No Data Found!',$e->getCode());
        }
    }    

    // insert category data
    public function storeCategory(Request $request){
        $rules = Validator::make($request->all(),[
            'name' => 'required',
            'status' => 'required'
        ]);

        if($rules->fails()){
            return send_error('Validation Error',$rules->messages(),$code = 422);
        }

        try{
            $category = Category::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'description' => $request->description,
                'status' => $request->status,
            ]);

            return send_response("Succesfully Inserted!",$category);

        }catch(Exception $e){
            return send_error($e->getMessage(),$e->getCode());
        }
    }

    // get category By Id for a single category
    public function getCategoryById($id){
        try{
            $category = Category::findOrFail($id);
            return send_response("fetch category data!",$category);
        }catch(Exception $e){
            return send_error('No Data Found!',$e->getCode());
        }
    }

    // edit category By Id for a single category
    // public function editCategoryById($id){
    //     try{
    //         $category = Category::findOrFail($id);
    //         return send_response("fetch category data!",$category);
    //     }catch(Exception $e){
    //         return send_error('No Data Found!',$e->getCode());
    //     }
    // }
    
        // update category By Id for a single category
    public function updateCategoryById(Request $request,$id){
        $rules = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required',
            'status' => 'required',
        ]);
    
        if($rules->fails()){
                return send_error('Validation Error',$rules->messages(),$code = 422);
        }
    
        try{
            $category = Category::findOrFail($id);
            $category->name = $request->name;
            $category->slug = Str::slug($request->name);
            $category->status = $request->status;
            $category->description = $request->description;
            $category->update();
    
            return send_response("succesfully updated!",$category);
    
        }catch(Exception $e){
            return send_error($e->getMessage(),$e->getCode());
        }
    }

    
        // delete Category By Id
    public function deleteCategoryById($id){
        try{
            $category = Category::findOrFail($id);
            $category->delete();
            return send_response("Successfull Deleted!");
        }catch(Exception $e){
            return send_error('No Data Found!',$e->getCode());
        }
    }
}
