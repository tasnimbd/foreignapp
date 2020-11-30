<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Category::latest()->paginate(10);
    }

    public function getCategoryForPost()
    {
        return Category::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $this->validate($request,[
            'cat_name' => 'required|min:2|max:50|unique:categories'
        ]);
        $data = New Category();
        $data->cat_name = $request->cat_name;
        $data->cat_slug = Str::slug($request->cat_name);
        $data->save();
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        //validation
        $this->validate($request,[
            'cat_name' => 'required|min:2|max:50|unique:categories,cat_name,'.$category->id
        ]);
        
        $category->cat_name = $request->cat_name;
        $category->cat_slug = Str::slug($request->cat_name);
        $category->save();

        //update post category table
        PostCategory::where('category_id', $id)->update([
            'cat_slug' => $category->cat_slug
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        //update post category table
        PostCategory::where('category_id', $id)->delete();

        return ['message' => 'its work'];
    }

    public function search(){

        if ($search = \Request::get('q')) {
            $categories = Category::where(function($query) use ($search){
                $query->where('cat_name','LIKE',"%$search%");
            })->paginate(10);
        }else{
            $categories = Category::latest()->paginate(10);
        }

        return $categories;

    }



}
