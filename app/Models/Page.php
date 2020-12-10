<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'slug', 'post', 'post_excerpt', 'meta_des', 'jsonData'
    ];

    public function setSlugAttribute($slug){
        $this->attributes['slug'] = $this->uniqueSlug($slug);
    }

    private function uniqueSlug($slug){
        $count = Page::where('slug', 'LIKE', "{$slug}%")->count();
        $newCount = $count > 0 ? ++$count : '';
        return $newCount > 0 ? "$slug-$newCount" : $slug;
    }
}
