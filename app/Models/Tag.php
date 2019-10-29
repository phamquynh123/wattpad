<?php

namespace App\Models;
use App\Models\Story;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    protected $fillable = [
        'title',
        'parent_id',
        'parent_language_id',
    ];

    public function stories()
    {
        return $this->belongsToMany(Story::class, 'story_tag', 'tag_id', 'story_id');
    }
}
