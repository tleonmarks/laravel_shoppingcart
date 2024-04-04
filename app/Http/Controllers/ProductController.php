<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function addproduct(){
        $categories=Category::All()->pluck('category_name','category_name');
        return view('admin.addproduct')->with('categories', $categories);;
    }

    public function products(){
       
        $products=Product::All();
        return view('admin.products')->with('products', $products);
    }
    public function saveproduct(Request $request){
        // return view('admin.categories');
        $this->validate($request, ['product_name'=>'required|unique:products',
                                  'product_price'=>'required',
                                 'product_category'=>'required',
                                 'product_image'=>'image|nullable|max:1999']);


        $product=Product::find($request->input('id'));
        if($request->hasFile('product_image')){
            // get name with ext
$fileNameWithExt =$request->file('product_image')->getClientOriginalName();
//get just file name
$fileName= pathinfo($fileNameWithExt, PATHINFO_FILENAME);
//get just file extension
$extension=$request->file('product_image')->getClientOriginalExtension();
// file name store
$fileNameToStore=$fileName.'_'.time().'.'.$extension;
//upload image
$path=$request->file('product_image')->storeAs('public/product_images', $fileNameToStore); 

}else{
$fileNameToStore='noimage.jpg'; 
}
        
        $product =new Product();
        $product->product_name=$request->input('product_name');
        $product->product_price=$request->input('product_price');
        $product->product_category=$request->input('product_category');   
        $product->product_image=$fileNameToStore;
        $product->product_status=1;
        $product->save();
        return back()-> with('status','The Product Has Been Succesfully Saved!');
     }
     
     public function editproduct($id){
        $product=Product::find($id);
        $categories=Category::All()->pluck('category_name','category_name');
        
       
        return view('admin.editproduct')->with('product', $product)->with('categories', $categories);
        
    }

    public function updateproduct(Request $request){
        $this->validate($request, ['product_name'=>'required',
        'product_price'=>'required',
       'product_category'=>'required',
       'product_image'=>'image|nullable|max:1999']);



        $product =Product::find($request->input('id'));
        $product->product_name=$request->input('product_name');
        $product->product_price=$request->input('product_price');
        $product->product_category=$request->input('product_category');   
       

        if($request->hasFile('product_image')){
            // get name with ext
            $fileNameWithExt =$request->file('product_image')->getClientOriginalName();
            //get just file name
            $fileName= pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get just file extension
            $extension=$request->file('product_image')->getClientOriginalExtension();
            // file name store
            $fileNameToStore=$fileName.'_'.time().'.'.$extension;
            //upload image
            $path=$request->file('product_image')->storeAs('public/product_images', $fileNameToStore); 
            if($product->product_image !='noimage.jpg'){
                Storage::delete('public/product_images/'.$product->product_image);
            }
            $product->product_image=$fileNameToStore;
            } 


        $product->update();
        return redirect('/products')->with('status', 'The Product has been updated succesfully');   
    }
    public function  deleteproduct($id){
        $product=Product::find($id);
        if($product->product_image !='noimage.jpg'){
            Storage::delete('public/product_images/'.$product->product_image);
        }
        $product->delete();
        return redirect('/products')->with('status', 'The Product has been deleted succesfully');
    }

 
    public function activateproduct($id){
        $product=Product::find($id);
        $product->product_status=1;
        $product->Update();
        return redirect('/products')->with('status', 'Product Activated succesfully');

    }
    public function unactivateproduct($id){
        $product=Product::find($id);
        $product->product_status=0;
        $product->Update();
        return redirect('/products')->with('status', 'Product Deactivated succesfully');
    }
    
    public function  view_product_by_category($category_name){

        $products=Product::All()->where('product_category', $category_name )->where('product_status', 1);
        $categories =Category::All();
        return view('client.shop')->with('products',$products)->with('categories', $categories );

    }
    
}
