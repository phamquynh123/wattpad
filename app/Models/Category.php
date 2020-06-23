<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'cate',
        'language_id',
        'parent_language_id',
    ];

    public function stories() {
        return $this->belongsToMany('App\Models\Story', 'category_story', 'category_id', 'story_id');
    }
}
