<?php

namespace App\Http\Controllers;

use App\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('categories.category');
    }
    public function add_category(Request $request)
    {
        $this->validate($request,[
            'category_name' => 'required',
        ]);
        $category = new Category;
        $category->category_name = $request->input('category_name');
        try{
            $category->save();
            return redirect('/category')->with('response', 'Category Added Successfully');
        }catch(Exception $e){
            return 'aa';
        }
    }
}
