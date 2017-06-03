<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\email\newuserwelcome;
use Auth;
use Session;
use App\News;
use Validator;

class HomeController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    
    
    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return view('home');
    }
    
    public function news(){
        
        $news = News::all();
        return view("pages.news",compact("news"));
    }
    
    public function cours(){
        
        return view("pages.cours");
    }
    
    public function contacts(){
        
        return view("pages.contacts");
    }
    public function postContact(Request $request){
        
        $rules = [
        'email' => 'required|email',
        'subject' => 'required',
        'message' => 'required|min:10',
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return response()->json(['status'=>'error','message'=>$validator->messages()]);
        }else{
            $data = array(
            'email'=>$request->email,
            'subject' =>$request->subject,
            'bodymessage'=>$request->message,
            
            );
            
            try{
                Mail::send('email.email',   $data,function($message)use ( $data){
                    $message->from($data['email']);
                    $message->to('antwerpenproject@outlook.com');
                    $message->subject($data['subject']);
                });
            }catch(\Exception $e){
                throw $e;
            }
            return response()->json(['status'=>'success','message'=>trans('main.successfule_sent')]);
        }
    }
    
}