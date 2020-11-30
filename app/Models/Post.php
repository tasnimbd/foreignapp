<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'title', 'slug', 'post', 'post_excerpt', 'feature_photo', 'tags', 'meta_des', 'jsonData'
    ];

    //auto slug generator
    /*public function setSlugAttribute($title){
        $this->attributes['slug'] = $this->uniqueSlug($title);
    }

    private function uniqueSlug($title){
        $slug = Str::slug($title, '-');
        $count = Post::where('slug', 'LIKE', "{$slug}%")->count();
        $newCount = $count > 0 ? ++$count : '';
        return $newCount > 0 ? "$slug-$newCount" : $slug;
    }
    */
    public function setSlugAttribute($slug){
        $this->attributes['slug'] = $this->uniqueSlug($slug);
    }

    private function uniqueSlug($slug){
        $count = Post::where('slug', 'LIKE', "{$slug}%")->count();
        $newCount = $count > 0 ? ++$count : '';
        return $newCount > 0 ? "$slug-$newCount" : $slug;
    }

    public function cat(){
        return $this->belongsToMany('App\Models\Category', 'post_categories');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
