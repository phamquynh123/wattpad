<?php

namespace App\Repositories\CategoryStory;

use App\Models\CategoryStory;
use App\Repositories\CategoryStory\CategoryStoryRepositoryInterface;
use App\Repositories\BaseRepository;

class CategoryStoryRepository extends BaseRepository implements CategoryStoryRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return CategoryStory::class;
    }

}
