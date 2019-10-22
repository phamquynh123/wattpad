<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use Notifiable;

    protected $fillable = [
        'name',
        'description'
        'avatar',
        'account_status' //vip or normal
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
}
