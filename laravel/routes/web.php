<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//L::Panel('admin');
L::LangNonymous();

Route::group(['middleware'=>'Lang'],function(){
    
    Route::get('/', function () {
        return view('home');
    });
    
    Auth::routes();
    
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/cours', 'HomeController@cours');
    
    Route::get('contact', ['uses' => 'HomeController@contacts', 'as' => 'contact']);
    Route::post('/contact','HomeController@postContact');
    
    
    
    
    
    Route::get('/news', 'NewsController@index')->name('news.index');
    Route::POST('/news', 'NewsController@store')->name('news.store')->middleware('admin:1');
    Route::get('/news/create', 'NewsController@create')->name('news.create')->middleware('admin:1');
    Route::get('/news/search/{id}', 'NewsController@search')->name('news.search');
    Route::get('/news/{id}/active', 'NewsController@active')->name('news.active');
    Route::delete('/news/{news}', 'NewsController@destroy')->name('news.destroy')->middleware('admin:1');
    Route::get('/news/{id}', 'NewsController@show')->name('news.show');
    Route::PATCH('/news/{id}', 'NewsController@update')->name('news.update')->middleware('admin:1');
    Route::get('news/{id}/edit',['uses'=>'NewsController@edit','as'=>'news.edit'])->middleware('admin:1');
    Route::get('news/{id}/delete',['uses'=>'NewsController@delete','as'=>'news.delete'])->middleware('admin:1');
    
    Route::get('/game', 'GameController@index')->name('game');
    
    
    
    
    // Route::get('/news/{min}/{limit}', 'NewsController@ajaxNews')->where(['min'=>'[0-9]+'])->where(['limit'=>'[0-9]+']);
    //Richtingen
    
    Route::resource('/richtingen','Richtingencontroller');
    
    
    //Testimonials
    Route::resource('/testimonials', 'TestimonialsController');
    Route::POST('/testimonials', 'TestimonialsController@store')->name('testimonials.store')->middleware('admin:3');
    Route::get('/testimonials/create', 'TestimonialsController@create')->name('testimonials.create')->middleware('admin:3');
    
    
    
    
    
    
    Route::get('/scholen', 'SchoolController@index');
    
    
    
    Route::group(['middleware' => 'auth'], function () {
        //rolees
        Route::get('/roles', 'RolesController@index');
        Route::post('roles/{id}/active',['uses'=>'RolesController@active','as'=>'roles.active']);
        Route::get('roles/search/{search}',['uses'=>'RolesController@search','as'=>'roles.search']);
        
    });
    
    
});