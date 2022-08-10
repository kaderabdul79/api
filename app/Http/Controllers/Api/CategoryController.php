<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

    // get Categories By Id for a single category
    public function getCategoryById($id){
        try{
            $category = Category::findOrFail($id);
            return send_response("fetch category data!",$category);
        }catch(Exception $e){
            return send_error('No Data Found!',$e->getCode());
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
