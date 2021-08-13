<?php

use Illuminate\Support\Facades\Route;

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

Route::view('/about', 'about'); // view('url', 'page')
Route::view('/contact', 'contact'); 
Route::view('/login', 'login'); 

// Route::get('posts/{slug}', 'PostController@show');

Route::get('posts', 'PostController@index')->name('posts.index'); 
Route::prefix('posts')->middleware('auth')->group(function ()
{
	// Route::get('posts', 'PostController@index')->name('posts.index')->withoutMiddleware('auth'); 
	Route::get('create', 'PostController@create')->name('posts.create');
	Route::post('store', 'PostController@store');
	
	Route::get('{post:slug}/edit', 'PostController@edit')->name('posts.edit');
	Route::patch('{post:slug}/edit', 'PostController@update');
	
	Route::delete('{post:slug}/delete', 'PostController@destroy');
	Route::get('{post:slug}', 'PostController@show')->name('posts.show')->withoutMiddleware('auth');
});

// Route::get('posts/create', 'PostController@create')->middleware('auth')->name('posts.create');
// Route::get('posts/{post:slug}', 'PostController@show');

Route::get('categories/{category:slug}', 'CategoryController@show')->name('categories.show');

Route::get('tags/{tag:slug}', 'TagController@show')->name('tags.show');


// Route::get('posts/{category:name}/{post:slug}', 'PostController@show');


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
