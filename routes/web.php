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

Route::get('/', function () {
    return view('welcome');
});

//admin post controller
Route::post('/upload', 'PostController@upload');
Route::post('/create-post', 'PostController@createPost');
Route::get('/deletepost/{id}', 'PostController@deletePost');
Route::post('/delete_image', 'PostController@deleteImage');
Route::get('blogsdata', 'PostController@blogdata'); // get the blogs item
Route::get('blogsingle/{id}', 'PostController@getSinglePostData'); // get the single post items
Route::post('updatepost/{id}', 'PostController@updatePost');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('pubgetcategory', 'FrontendController@getCategories');
//Route::get('pubgetcategorywithcount', 'FrontendController@getCategoriesCount');
//Route::get('pubgetpost', 'FrontendController@getPost');
//Route::get('publatestpost', 'FrontendController@pubLatestPost');


Route::post('/createpost', 'AdminContrller@uploadEditorImage');

Route::get('{path}', 'HomeController@index')->where( 'path', '([A-z\d\/.]+)?' );
//Route::get('{path}', 'HomeController@index')->where( 'path', '([A-z\d-/_.]+)?' );
