<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    // getAllCategories list
    public function getAllCategories(){
        $categories = Category::all();
        return response()->json([
            'categories' => $categories
        ]);
    }

    // getCategoriesById for a single category
    public function getCategoryById(Request $request){
        $category = Category::findOrFail($request->id);
        return response()->json([
            'category' => $category
        ]);
    }

    // deleteCategoryById
    public function deleteCategoryById(Request $request){
        $category = Category::findOrFail($request->id);
        $category->delete();
        return response()->json([
            'success' => true,
            'message' => 'deleted'
        ]);
    }
}
