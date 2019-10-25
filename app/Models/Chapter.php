<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $table = 'chapters';

    protected $fillable = [
        'story_id',
        'title',
        'slug',
        'content',
        'public_status',
        'parent_language_id',
        'language_id',
    ];
}
