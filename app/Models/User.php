<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'description',
        'avatar',
        'account_status', //vip or normal
        'role_id',
        'status', //active deactive
        'password',
        'email',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo('App\Models\Role', 'role_id', 'id');
    }

    public function story()
    {
        return $this->belongsToMany('App\Models\Story', 'story_author', 'user_id', 'story_id');
    }

    // public function role_user()
    // {
    //     return $this->belongsTo('App\Models\RoleUser', 'user_id', 'id');
    // }

}
