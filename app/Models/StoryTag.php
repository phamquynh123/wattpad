<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoryTag extends Model
{
    protected $table = 'story_tag';
    protected $fillable = [
        'story_id',
        'tag_id',
    ];
}
