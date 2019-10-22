<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $table = 'stories';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'original',
        'public_status',
        'img',
        'use_status',
        'view_count',
        'total_vote',
    ];

    public function authors()
    {
        return $this->belongsToMany('App\Models\Author', 'story_author', 'story_id', 'author_id');
    }

    public function categoties()
    {
        return $this->belongsToMany('App\Models\Category', 'category_story', 'story_id', 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'story_tag', 'story_id', 'tag_id');
    }
}
