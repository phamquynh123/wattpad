<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];

    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permissions', 'permission_role');
    }

    public function permission_role()
    {
        return $this->belongsTo('App\Models\PermissionRole', 'role_id');
    }
}
