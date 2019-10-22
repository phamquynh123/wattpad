<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $table = 'votes';
    protected $fillable = [
        'title',
    ];
}
