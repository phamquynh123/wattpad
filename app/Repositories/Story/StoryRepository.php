<?php

namespace App\Repositories\Story;

use App\Models\Story;
use App\Repositories\Story\StoryRepositoryInterface;
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

    public function detailStory($attr, $value)
    {
        $result = $this->_model::where($attr, $value)->first();

        return $result;
    }

}
