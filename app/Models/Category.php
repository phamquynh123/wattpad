<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'title',
        'slug',
        'description',
        'parent_id',
        'language_id',
        'parent_language_id',
    ];
}
