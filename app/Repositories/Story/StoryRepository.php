<?php

namespace App\Repositories\Batch;

use App\Models\Story;
use App\Repositories\Batch\StoryRepositoryInterface;
use App\Repositories\BaseRepository;

class StoryRepository extends BaseRepository implements StoryRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Story::class;
    }

}
