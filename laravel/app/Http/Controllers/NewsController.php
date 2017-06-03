<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\News;
use Session;
use Auth;
use Input;
use DB;
use Image;

use App\Http\Requests;

use Illuminate\Support\Facades\Redirect;

class NewsController extends Controller
{
    public function index(){
        $stack = array();
        if(Auth::check() && Auth::user()->roles == 0 |Auth::user()->roles == null ){
            $news = News::where('active','=', 1)
            ->orderBy('created_at','DEC')
            ->get();
        }elseif(Auth::check() &&  Auth::user()->roles == 1){
            $news = News::where('active','=', 1)
            ->orWhere('user_id', '=', Auth::user()->id)
            ->orderBy('created_at','DEC')
            ->get();
            
        }elseif(Auth::check() && Auth::user()->roles > 1){
            $news = News::all();
        }else{
            $news = News::where('active','=', 1)
            ->orderBy('created_at','DEC')
            ->get();
        }
        
        
        
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://www.gate15.be/srv/content/d/content-type/10/start/0/limit/50/excluded_tags/trots');
        
        
        if($res->getStatusCode() == 200){
            $data = json_decode($res->getBody());
            foreach ($data->data as $k =>  $d) {
                $stack[] = array(
                'title' => $d->title,
                'url' =>"https://www.gate15.be/nl/nieuws/" .$d->slug,
                'pic' => $d->snippets[0]->body->file[0]->src,
                'text' => (array_key_exists('2',$d->snippets) && property_exists($d->snippets[2]->body,'text'))?$d->snippets[2]->body->text :'',
                );
            }
        }
        
        //  dd(array_merge($news->toarray(),$stack));
        return view('news.index',['news'=>array_merge($news->toarray(),$stack)]);
        
        
        
    }
    
    public function create(){
        return view("news.add");
    }
    
    public function store(Request $request){
        
        
        $rules = [
        'pic' =>'image|mimes:jpeg,png,jpg,gif|',
        'title' => 'required|max:225',
        'text' => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return response()->json(['status'=>'error','message'=>$validator->messages()]);
        }else{
            if(Auth::check() &&  Auth::user()->roles == 1){
                $news = new News();
                if($request->hasFile('pic')){
                    $pic = $request->file('pic');
                    
                    $fileName = time() . '.'.$pic->getClientOriginalExtension();
                    // 'images/cars/' . $filename;
                    if(Image::make($pic)->save(public_path('images/posts_images/'.$fileName))){
                        $news->pic = $fileName;
                    }
                }
                
                $news->title = $request->title;
                $news->text = $request->text;
                
                $news->user_id = auth()->user()->id;
                if($news->save()){
                    return response()->json(['status'=>'success','message'=>trans('main.successfule_sent')]);
                }
                
                
            }
            
            
            
            
        }
        
    }
    
    public function show($id){
        //    echo 'test';
        // exit();
        $news = News::findOrFail($id);
        return view("news.show",compact("news"));
    }
    
    public function edit($id){
        $news = News::find($id);
        return view('news.edit')->withNews($news);
    }
    
    public function update(Request $request, $id){
        $rules = [
        'pic' =>'image|mimes:jpeg,png,jpg,gif|',
        'title' => 'required|max:225',
        'text' => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return response()->json(['status'=>'error','message'=>$validator->messages()]);
        }else{
            if(Auth::check() &&  Auth::user()->roles == 1){
                $news = News::find($id);
                if($request->hasFile('pic')){
                    $pic = $request->file('pic');
                    $fileName = time() . '.'.$pic->getClientOriginalExtension();
                    // 'images/cars/' . $filename;
                    if(Image::make($pic)->save(public_path('images/posts_images/'.$fileName))){
                        $news->pic = $fileName;
                    }
                }
                
                $news->title = $request->title;
                $news->text = $request->text;
                
                $news->user_id = Auth::user()->id;
                if($news->save()){
                    return response()->json(['status'=>'success','message'=>trans('main.successfule_sent')]);
                }
                
                
            }
            
            
            
            
        }
        
        
        
    }
    //g	et
    public function active($id){
        
        if(Auth::user()->roles >1){
            try{
                $news = News::find($id);
                if($news){
                    $news->active = 1;
                    $news->save();
                }else{
                    echo 'false';
                    exit;
                }
            }catch(Exception $e) {
                echo 'false';
            }
            echo 'true';
        }
    }
    
    public function search($id){
        if(Auth::check() && $id == 2 && Auth::user()->roles >1){
            $news = News::where('active','=', 0)
            ->orderBy('created_at','DEC')
            ->get();
        }elseif(Auth::check() && $id == 3  && Auth::user()->roles >1){
            $news = News::where('active','=', 1)
            ->orderBy('created_at','DEC')
            ->get();
        }else{
            return redirect()->to('news');
        }
        //  dd($news);
        return view("news.index",['news'=>$news,'search'=>$id]);
    }
    public function delete($id)
    {
        $news = News::find($id);
        return view('news.delete')->withNews( $news);
    }
    public function destroy($id)
    {
        $news = News::find($id);
        $news_id= $news->id;
        $news->delete();
        Session::flash('success','the news was deleted');
        return redirect()->route("news.index");
    }
}