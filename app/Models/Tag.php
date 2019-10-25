<?php

namespace App\Model;
use App\Models\Story;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    protected $fillable = [
        'title',
        'parent_id',
        'language_id',
    ];

    public function stories()
    {
        return $this->belongsToMany(Story::class, 'story_tag', 'tag_id', 'story_id');
    }
}
