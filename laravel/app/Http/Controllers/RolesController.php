<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\User;
use Session;
use Auth;
class RolesController extends Controller
{
    public function index(){
        if(Auth::user()->roles == 3 or true){
            $users = user::all();
            return view("roles",["users"=>$users]);
        }
        return Redirect::to("/");
        
    }
    
    
    public function edit($id){
        $news = News::find($id);
        return view('news.edit')->withNews($news);
    }
    
    //g	et
    public function update($id){
        // echo 'ena d5alet  '.$id;
        if(Auth::user()->roles >1){
            $news = News::find($id);
            $news->active = 1;
            $news->save();
        }
        
        // echo 'ena kamelet  '.$id;
    }
    public function active($id,Request $request){
        
        if(Auth::user()->roles ==3){
            $user = User::findOrFail($id);
            $user->roles =$request->roles;
            $user->save();
        }
        
        return back();
    }
    public function search($search){
        if(Auth::user()->roles == 3 ){
            $users = User::where('name', 'LIKE', "%".$search."%")
            ->orWhere('email', 'LIKE', "%".$search."%")->get();
        }else{
            return Redirect::to("/");
        }
        return view("roles", ['users'=>$users]);
    }
    
    public function delete($id){
        $news = News::find($id);
        return view('news.delete')->withNews( $news);
    }
    public function destroy($id){
        $news = News::find($id);
        $news_id= $news->id;
        $news->delete();
        Session::flash('success','the news was deleted');
        return redirect()->route('news.show',  $news_id);
    }
}