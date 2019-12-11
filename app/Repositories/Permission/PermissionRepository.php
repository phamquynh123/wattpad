<?php

namespace App\Repositories\Permission;

use App\Models\Permission;
use App\Repositories\Permission\PermissionRepositoryInterface;
use App\Repositories\BaseRepository;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Permission::class;
    }

}
