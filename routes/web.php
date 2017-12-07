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
//Auth
Auth::routes();
// Route::get('/login', "LoginController@login");
// Route::post('/login', "LoginController@login");
// Route::get('/logout', "Auth\LoginController@logout");
// //Register
// Route::get('/register', "RegisterController@showRegistrationForm");
// Route::post('/register', "RegisterController@register");

Route::get('/home', "PagesController@Index");
Route::get('/', "PagesController@Index");
Route::get('/homepage', "PagesController@Index");

Route::get('/contact', "PagesController@Contact");
Route::get('/about', "PagesController@About");

//Created New Controller 'PostController --resource' and it created all needed functions
//Chooses Automatically Function
Route::resource('post', "PostController");
Route::resource("tags", "TagController", ['except' => ['create']]);

Route::post('comments/{post_id}', ["uses" => "CommentsController@store", "as" => "comments.store"]);


Route::get('/blogs/{slug}',  ["as" => 'blog.single', "uses" => "BlogController@getSingle"]);//->where("slug", "[\w\d\-\_]+");//Where there can only be
Route::get('/blogs', ['uses' => 'BlogController@Index', 'as' => 'blog.index']);

Route::resource("categories", "CategoryController", ['except' => ['create']]);
