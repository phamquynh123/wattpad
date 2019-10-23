<?php

namespace App\Repositories\Batch;

use App\Models\Batch;
use App\Repositories\Batch\BatchRepositoryInterface;
use App\Repositories\BaseRepository;

class BatchRepository extends BaseRepository implements BatchRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Batch::class;
    }

}
