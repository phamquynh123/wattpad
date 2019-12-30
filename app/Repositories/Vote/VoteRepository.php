<?php

namespace App\Repositories\Vote;

use App\Models\Vote;
use App\Repositories\Vote\VoteRepositoryInterface;
use App\Repositories\BaseRepository;

class VoteRepository extends BaseRepository implements VoteRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Vote::class;
    }

}
