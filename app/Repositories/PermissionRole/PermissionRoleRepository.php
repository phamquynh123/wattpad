<?php

namespace App\Repositories\PermissionRole;

use App\Models\PermissionRole;
use App\Repositories\PermissionRole\PermissionRoleRepositoryInterface;
use App\Repositories\BaseRepository;

class PermissionRoleRepository extends BaseRepository implements PermissionRoleRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return PermissionRole::class;
    }

}
