<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'language_id',
        'parent_language_id',
    ];
}
