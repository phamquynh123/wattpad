<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CategoryStory extends Model
{
    protected $table = 'category_story';

    protected $fillable = [
        'story_id',
        'category_id',
    ];
    
}
