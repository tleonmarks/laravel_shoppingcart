<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function addslider(){
        return view('admin.addslider');
    }
    public function sliders(){
        $sliders=Slider::All();
        return view('admin.sliders')->with('sliders', $sliders);
    }
    
    public function saveslider(Request $request){
        $this->validate($request, ['description1'=>'required',
        'description2'=>'required',
       'slider_image'=>'image|nullable|max:1999']);


$slider=Slider::find($request->input('id'));
if($request->hasFile('slider_image')){
// get name with ext
$fileNameWithExt =$request->file('slider_image')->getClientOriginalName();
//get just file name
$fileName= pathinfo($fileNameWithExt, PATHINFO_FILENAME);
//get just file extension
$extension=$request->file('slider_image')->getClientOriginalExtension();
// file name store
$fileNameToStore=$fileName.'_'.time().'.'.$extension;
//upload image
$path=$request->file('slider_image')->storeAs('public/slider_images', $fileNameToStore); 

}else{
$fileNameToStore='noimage.jpg'; 
}

$slider =new Slider();
$slider->description1=$request->input('description1');
$slider->description2=$request->input('description2');  
$slider->slider_image=$fileNameToStore;
$slider->status=1;
$slider->save();
return back()-> with('status','The Slider Has Been Succesfully Saved!');
    }
    public function editslider($id){
        $slider=Slider::find($id);
        return view('admin.editslider')->with('slider', $slider);

    }
    public function updateslider(Request $request){
        $this->validate($request, ['description1'=>'required',
        'description2'=>'required',
       'slider_image'=>'image|nullable|max:1999']);



        $slider =Slider::find($request->input('id'));
        $slider->description1=$request->input('description1');
        $slider->description2=$request->input('description2');
        
       

        if($request->hasFile('slider_image')){
            // get name with ext
            $fileNameWithExt =$request->file('slider_image')->getClientOriginalName();
            //get just file name
            $fileName= pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get just file extension
            $extension=$request->file('slider_image')->getClientOriginalExtension();
            // file name store
            $fileNameToStore=$fileName.'_'.time().'.'.$extension;
            //upload image
            $path=$request->file('slider_image')->storeAs('public/slider_images', $fileNameToStore); 
            if($slider->slider_image !='noimage.jpg'){
                Storage::delete('public/slider_images/'.$slider->slider_image);
            }
            $slider->slider_image=$fileNameToStore;
            } 


        $slider->update();
        return redirect('/sliders')->with('status', 'The Slider has been updated succesfully');   

    }
    public function deleteslider ($id){
        $slider=Slider::find($id);
        if($slider->slider_image !='noimage.jpg'){
            Storage::delete('public/slider_images/'.$slider->slider_image);
        }
        $slider->delete();
        return redirect('/sliders')->with('status', 'The Slider has been deleted succesfully');
  

    }
    public function activateslider ($id){
        $slider=Slider::find($id);
        $slider->status=1;
        $slider->Update();
        return redirect('/sliders')->with('status', 'Slider Activated succesfully');


    }
    public function unactivateslider ($id){
        $slider=Slider::find($id);
        $slider->status=0;
        $slider->Update();
        return redirect('/sliders')->with('status', 'Slider Deactivated succesfully');
   
    }
   

}
