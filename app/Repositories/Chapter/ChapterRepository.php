<?php

namespace App\Repositories\Chapter;

use App\Models\Chapter;
use App\Repositories\Chapter\ChapterRepositoryInterface;
use App\Repositories\BaseRepository;

class ChapterRepository extends BaseRepository implements ChapterRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Chapter::class;
    }

    public function countChapter($attr, $id)
    {
        $result = $this->_model->where($attr, $id)->count();

        return $result;
    }
}
