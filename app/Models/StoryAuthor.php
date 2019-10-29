<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoryAuthor extends Model
{
    protected $table = 'story_author';
    protected $fillable = [
        'story_id',
        'user_id',
    ];

}
