<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function getCategories(){
        return $categories = Category::all();
    }
    public function getCategoriesCount(){
        return $categories = Category::withCount('post_count')->get();
    }
    public function getPost(){
        return $posts = Post::with(['cat', 'user'])->latest()->paginate(1);
    }

    public function pubLatestPost(){
        return $posts = Post::orderBy('id', 'desc')->get(['title', 'post_excerpt', 'slug', 'feature_photo', 'created_at']);
    }
}
