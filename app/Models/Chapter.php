<?php

namespace App\Models;

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

    public function story()
    {
        return $this->belongsTo('App\Models\Story', 'story_id');
    }

    public function comment()
    {
        
    }
}
