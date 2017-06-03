<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Testimonials;
use DB;
use Input;
use Auth;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

use Image;

class TestimonialsController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        
        $testimonials =DB::table('testimonials')->get();
        return view('Testimonials.index',compact('testimonials'));
    }
    
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('Testimonials.create');
    }
    
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $rules = [
        'image_cover' =>'image|mimes:jpeg,png,jpg,gif|',
        'name' => 'required|max:225',
        'text' => 'required',
        "url"=>"required|url",
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return response()->json(['status'=>'error','message'=>$validator->messages()]);
        }else{
            if(Auth::check() &&  Auth::user()->roles == 3){
                $testimonial = new Testimonials();
                if($request->hasFile('image_cover')){
                    $pic = $request->file('image_cover');
                    
                    $fileName = time() . '.'.$pic->getClientOriginalExtension();
                    // 'images/cars/' . $filename;
                    if(Image::make($pic)->save(public_path('images/posts_images/'.$fileName))){
                        $testimonial->image_cover = $fileName;
                    }
                }
                
                $testimonial->name = $request->name;
                $testimonial->text = $request->text;
                $testimonial->url = $request->url;
                
                
                if($testimonial->save()){
                    return response()->json(['status'=>'success','message'=>trans('main.successfule_sent')]);
                }
                
                
                
                
                
                
                
            }else{
                
                
            }
            
            
            
            
        }
    }
    
    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        //
    }
    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        //
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        //
    }
}