<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function addcategory(){
        return view('admin.addcategory');
    }
    public function categories(){
        $categories=Category::All();
        return view('admin.categories')->with('categories', $categories);
    } 
    public function savecategory(Request $request){
       // return view('admin.categories');
       $this->validate($request, ['category_name'=>'required|unique:categories']);  
       $category =new Category();
       $category->category_name=$request->input('category_name');
       $category->save();
       return back()-> with('status','The Category Has Been Succesfully Saved!');
    }
    public function edit_category($id){
        $category=Category::find($id);
        return view('admin.edit_category')->with('category', $category);
        
    }
    

    public function updatecategory(Request $request){
        $this->validate($request, ['category_name'=>'required|unique:categories']); 
        $category=Category::find($request->input('id'));
        $category->category_name=$request->input('category_name');
        $category->update();
        return redirect('/categories')->with('status', 'The category has been updated succesfully');   
    }
    public function  deletecategory($id){
        $category=Category::find($id);
        $category->delete();
        return back()->with('status', 'The category has been deleted succesfully');
    }


}
