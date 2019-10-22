<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'story_id';

    protected $fillable = [
        'story_id',
        'user_id',
        'content',
    ];
}
