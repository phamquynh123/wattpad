<?php

namespace App\Models;

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
        'parent_language_id',
        'language_id',
    ];

    public function authors()
    {
        return $this->belongsToMany('App\Models\User', 'story_author', 'story_id', 'user_id');
    }

    public function categoties()
    {
        return $this->belongsToMany('App\Models\Category', 'category_story', 'story_id', 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'story_tag', 'story_id', 'tag_id');
    }

    public function chapter()
    {
        return $this->hasMany('App\Models\Chapter', 'story_id', 'id');
    }

    public function chapterCustom()
    {
        return $this->hasMany('App\Models\Chapter', 'story_id', 'id')->select(['content']);
    }

    public function comment()
    {
        return $this->hasMany('App\Models\Comment', 'story_id', 'id');
    }
}
