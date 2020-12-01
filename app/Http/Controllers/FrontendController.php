<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function index(){
        return view('app');
    }

    public function getCategories(){
        return $categories = Category::all();
    }
    public function getCategoriesCount(){
        return $categories = Category::withCount('post_count')->get();
    }
    public function getPost(){
        return $posts = Post::with(['cat', 'user'])->latest()->paginate(2);
    }

    public function pubLatestPost(){
        return $posts = Post::orderBy('id', 'desc')->get(['title', 'post_excerpt', 'slug', 'feature_photo', 'created_at']);
    }

    /*public function frontendsearch(){

        if ($search = \Request::get('q')) {
            $posts = Post::where(function($query) use ($search){
                $query->where('title','LIKE',"%$search%");
            })->paginate(10);
        }else{
            $posts = Post::latest()->paginate(10);
        }

        return $posts;

    }*/

    public function getpost_by_slug($slug){
        $post = Post::with(['cat', 'user'])->where('slug',$slug)->first();
        return response()->json([
            'post'=>$post
        ],200);
    }













}
