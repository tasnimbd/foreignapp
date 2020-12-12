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

Route::get('/', 'FrontendController@index');

//admin post controller
Route::post('/upload', 'PostController@upload');
Route::post('/create-post', 'PostController@createPost');
Route::get('/deletepost/{id}', 'PostController@deletePost');
Route::post('/delete_image', 'PostController@deleteImage');
Route::get('blogsdata', 'PostController@blogdata'); // get the blogs item
Route::get('blogsingle/{id}', 'PostController@getSinglePostData'); // get the single post items
Route::post('updatepost/{id}', 'PostController@updatePost');
Route::get('findpost', 'PostController@searchPost');

//fix admin routing for reloading
Route::get('/categories', 'HomeController@index');

Route::get('/manageposts', 'HomeController@index');
Route::get('/createpost', 'HomeController@index');

Route::get('/managepages', 'HomeController@index');
Route::get('/createpage', 'HomeController@index');
Route::get('/dashboard', 'HomeController@index');
//fix admin routing for reloading

//admin page routes
Route::post('/create-page', 'PostController@createPage');
Route::get('pagedata', 'PostController@getPageData'); // get the page item
Route::get('pagesingle/{id}', 'PostController@getSinglePageData'); // get the single post items
Route::post('updatepage/{id}', 'PostController@updatePage');
Route::get('/deletepage/{id}', 'PostController@deletePage');
Route::get('findpage', 'PostController@searchPage');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('pubgetcategory', 'FrontendController@getCategories');
Route::get('pubgetcategorywithcount', 'FrontendController@getCategoriesCount');
Route::get('pubgetpost', 'FrontendController@getPost');
Route::get('category/pubgetcatpost/{cat_slug}', 'FrontendController@getPostByCatSlug');
Route::get('publatestpost', 'FrontendController@pubLatestPost');

//extra
Route::get('blog/pubgetcategorywithcount', 'FrontendController@getCategoriesCount');
Route::get('blog/publatestpost', 'FrontendController@pubLatestPost');
Route::get('blog/pubgetcategory', 'FrontendController@getCategories');

//search extra for frontend
Route::get('search/pubgetcategorywithcount', 'FrontendController@getCategoriesCount');
Route::get('search/publatestpost', 'FrontendController@pubLatestPost');
Route::get('search/pubgetcategory', 'FrontendController@getCategories');

//extra for category page
Route::get('category/pubgetcategorywithcount', 'FrontendController@getCategoriesCount');
Route::get('category/publatestpost', 'FrontendController@pubLatestPost');
Route::get('category/pubgetcategory', 'FrontendController@getCategories');
Route::get('search/search', 'FrontendController@frontendsearch');

Route::get('/singlepost/{slug}','FrontendController@getpost_by_slug');
Route::get('/singlepage/{slug}','FrontendController@getpage_by_slug');


//laravel blog routes
Route::get('/blog/{slug}','FrontendController@getpost_by_slug_lara');
Route::get('/category/{cat_slug}','FrontendController@getpost_by_cat_slug_lara');
Route::get('/{slug}','FrontendController@getpage_by_slug_lara');
Route::get('/search/{keyword}','FrontendController@searchpage');

Route::post('sendmessage','FrontendController@sendMessage');





Route::post('/createpost', 'AdminContrller@uploadEditorImage');
Route::post('/createpage', 'AdminContrller@uploadEditorImage');

Route::get('{path}', 'HomeController@index')->where( 'path', '([A-z\d\/.]+)?' );
//Route::get('{path}',"HomeController@index")->where('path','[-a-z0-9_\s]+');
Route::get('{path}', 'FrontendController@index')->where('path','[-a-z0-9_\s]+');

/*Route::get('{any}', function () {
    return view('app');
})->where('any','.*');*/

//Route::get('/{any}', function() { return view('app'); })->where('any', '(.*)');
//Route::get('/blog/{slug}', function () { return view('app'); })->where('slug', '[\/\w\.-]*');

/*Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');*/
