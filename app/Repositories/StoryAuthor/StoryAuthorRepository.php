<?php

namespace App\Repositories\StoryAuthor;

use App\Models\StoryAuthor;
use App\Repositories\StoryAuthor\StoryAuthorRepositoryInterface;
use App\Repositories\BaseRepository;

class StoryAuthorRepository extends BaseRepository implements StoryAuthorRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return StoryAuthor::class;
    }

}
