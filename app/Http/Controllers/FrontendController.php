<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Post;
use App\Models\Category;
use App\Mail\SendMessage;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{
    public function index(){
        return view('app');
    }

    public function sendmessage(Request $request){
        $data = array();
		$data['cusname'] = $request->cusname;
		$data['phone'] = $request->phone;
		$data['email'] = $request->email;
		$data['subject'] = $request->subject;
		$data['message'] = $request->message;
        Mail::to('outsourcingwall@gmail.com')->send(new SendMessage($data));
    return 'Done';
        
    }

    public function getCategories(){
        return $categories = Category::all();
    }
    public function getCategoriesCount(){
        return $categories = Category::withCount('post_count')->get();
    }
    public function getPost(){
        return $posts = Post::with(['cat', 'user'])->latest()->paginate(4);
    }

    public function pubLatestPost(){
        return $posts = Post::orderBy('id', 'desc')->get(['title', 'post_excerpt', 'slug', 'feature_photo', 'created_at']);
    }

    public function frontendsearch(){

        if ($search = \Request::get('q')) {
            $posts = Post::with(['cat', 'user'])->where(function($query) use ($search){
                $query->where('title','LIKE',"%$search%");
            })->get();
        }else{
            $posts = 'nothing found';
        }

        return $posts;

    }

    public function getpost_by_slug($slug){
        $post = Post::with(['cat', 'user'])->where('slug',$slug)->first();
        return response()->json([
            'post'=>$post
        ],200);
    }

    public function getpost_by_slug_lara($slug){
        return view('app');
    }
    public function getpost_by_cat_slug_lara($slug){
        return view('app');
    }
    public function searchpage($keyword){
        return view('app');
    }

    public function getPostByCatSlug($cat_slug){
        $catId = Category::where('cat_slug', $cat_slug)->first();
        $catIdBySlug = $catId->id;

        return $posts = Post::with('user')->whereHas('cat', function($q) use($catIdBySlug){
            $q->where('category_id', $catIdBySlug);
        })->orderBy('id', 'desc')->latest()->paginate(2);
    }


    //for page
    public function getpage_by_slug($slug){
        $page = Page::where('slug',$slug)->first();
        
        //if($page !=null){
            return response()->json([
                'page'=>$page
            ],200);
        /*}else{
            return response()->json([
                'page'=> 'nothing found'
            ],200);
        }*/
        
    }
    public function getpage_by_slug_lara($slug){
        return view('app');
    }










}
