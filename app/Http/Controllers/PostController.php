<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    //feature_photo upload
    public function upload(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:jpeg,jpg,png',
        ]);
        $picName = time() . '.' . $request->file->extension();
        $request->file->move(public_path('uploads'), $picName);
        return $picName;
    }
    //delete image from the post form and server
    public function deleteImage(Request $request)
    {
        $fileName = $request->imageName;
        //return $fileName;die();
        $this->deleteFileFromServer($fileName, false);
        return 'done';
    }
    public function deleteFileFromServer($fileName, $hasFullPath = false)
    {
        if (!$hasFullPath) {
            $filePath = public_path() . $fileName;
            
        }
        if (file_exists($filePath)) {
            @unlink($filePath);
        }
        return;
    }
    //end delete image

    public function createPost(Request $request){
        $categories = $request->category_id;
        $postCategories = [];
        DB::beginTransaction();
        try {
            $post = Post::create([
                'title' => $request->title,
                'slug' => $request->slug,
                'post' => $request->post,
                'post_excerpt' => $request->post_excerpt,
                'user_id' => Auth::user()->id,
                'meta_des' => $request->meta_des,
                'jsonData' => $request->jsonData,
                'tags' => $request->tags,
                'feature_photo' => $request->feature_photo,
            ]);
            // insert blog categories
            foreach ($categories as $c) {
                $catidslug = Category::where('id', $c)->first();
                array_push($postCategories, ['category_id' => $catidslug->id, 'cat_slug' =>$catidslug->cat_slug,  'post_id' => $post->id, 'post_slug' => $post->slug]);
            }
            PostCategory::insert($postCategories);
            
            DB::commit();
            return 'done';
        } catch (\Throwable $th) {
            DB::rollback();
            return 'not done';
        }

       
    }

    // update post
    public function updatePost(Request $request, $id)
    {
        
        $categories = $request->category_id;
        $postCategories = [];

        DB::beginTransaction();
        try {
            $blog = Post::where('id', $id)->update([
                'title' => $request->title,
                'slug' => $request->slug,
                'post' => $request->post,
                'post_excerpt' => $request->post_excerpt,
                'user_id' => Auth::user()->id,
                'meta_des' => $request->meta_des,
                'jsonData' => $request->jsonData,
                'tags' => $request->tags,
                'feature_photo' => $request->feature_photo,
            ]);


            // insert blog categories
            foreach ($categories as $c) {
                $catidslug = Category::where('id', $c)->first();
                array_push($postCategories, ['category_id' => $catidslug->id, 'cat_slug' =>$catidslug->cat_slug,  'post_id' => $id, 'post_slug' => $request->slug]);
            }
            // delete all previous categories
            PostCategory::where('post_id', $id)->delete();
            PostCategory::insert($postCategories);
            
            DB::commit();
            return 'done';
        } catch (\Throwable $e) {

            DB::rollback();
            return 'not done';
        }
    }

    public function blogdata()
    {
        return $blogs = Post::with(['cat','user'])->orderBy('id', 'desc')->paginate(20);

    }

    public function deletePost($id){
        $post = Post::findOrFail($id);
        $post->delete();

        $postcategories = PostCategory::where('post_id', $id)->delete();
    }

    public function getSinglePostData($id)
    {
        return Post::with(['cat'])->where('id', $id)->first();

    }

    public function searchPost(){

        if ($search = \Request::get('q')) {
            $blogs = Post::where(function($query) use ($search){
                $query->where('title','LIKE',"%$search%");
            })->paginate(20);
        }else{
            $blogs = Post::latest()->paginate(20);
        }

        return $blogs;

    }

    //for page
    public function createPage(Request $request){
        $post = Page::create([
                'title' => $request->title,
                'slug' => $request->slug,
                'post' => $request->post,
                'meta_des' => $request->meta_des,
                'jsonData' => $request->jsonData,
            ]);
        if($post){

            return 'done';
        }else{
            return 'not done';
        }

       
    }

    public function getPageData()
    {
        return $pages = Page::orderBy('id', 'desc')->paginate(20);

    }

    public function getSinglePageData($id)
    {
        return Page::where('id', $id)->first();

    }

    public function updatePage(Request $request, $id)
    {
        
        $page = Page::where('id', $id)->update([
                'title' => $request->title,
                'slug' => $request->slug,
                'post' => $request->post,
                'meta_des' => $request->meta_des,
                'jsonData' => $request->jsonData,
            ]);
        if($page){

            return 'done';
        }else{
            return 'not done';
        }

    }

    public function deletePage($id){
        $page = Page::findOrFail($id);
        $page->delete();
    }

    public function searchPage(){

        if ($search = \Request::get('q')) {
            $pages = Page::where(function($query) use ($search){
                $query->where('title','LIKE',"%$search%");
            })->paginate(20);
        }else{
            $pages = Page::latest()->paginate(20);
        }

        return $pages;

    }










}
