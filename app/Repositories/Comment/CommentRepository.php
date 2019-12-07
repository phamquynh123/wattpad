<?php

namespace App\Repositories\Comment;

use App\Models\Comment;
use App\Repositories\Comment\CommentRepositoryInterface;
use App\Repositories\BaseRepository;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Comment::class;
    }

    public function countComment($attr, $id)
    {
        $result = $this->_model->where($attr, $id)->count();

        return $result;
    }
}
